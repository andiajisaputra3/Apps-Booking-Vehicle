<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Booking;
use App\Models\BookingHistories;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function index()
    {
        $approvals = Approval::all();
        return view('approvals.index', compact('approvals'));
    }

    public function approve(Request $request, Booking $booking)
    {
        /** @var App\Models\User */
        $user = Auth::user();

        // Pastikan hanya user dengan role approver yang dapat melakukan approve/reject
        if (!$user->hasRole('approver')) {
            return response()->json([
                'status' => 'error',
                'message' => 'You do not have permission to approve or reject.',
            ], 403);
        }

        // Validasi input
        $request->validate([
            'notes' => 'nullable|string|max:255',
        ]);

        // Cek apakah approval level sebelumnya sudah disetujui
        $previousApproval = Approval::where('booking_id', $booking->id)
            ->where('approval_level', '<', $booking->current_approval_level)
            ->orderBy('approval_level', 'desc')
            ->first();

        // Jika level sebelumnya belum approved, tidak bisa approve level ini
        if ($previousApproval && $previousApproval->status !== 'approved') {
            return response()->json([
                'status' => 'error',
                'message' => 'Previous approval levels must be completed before this level can be approved.',
            ], 400);
        }

        // Dapatkan approval untuk level yang dimaksud
        $approval = Approval::where('booking_id', $booking->id)
            ->where('approval_level', $booking->current_approval_level)
            ->where('user_id', $user->id)
            ->firstOrFail();

        if ($approval->status !== 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'You have already responded to this approval level.'
            ], 400);
        }

        // Update status approval menjadi approved
        $approval->update([
            'status' => 'approved',
            'notes' => $request->notes ?: 'Approved',
            'approved_at' => now(),
        ]);

        // Jika level persetujuan adalah level 1, set approval status menjadi in progress 
        if ($booking->current_approval_level == 1) {
            $booking->update([
                'approval_status' => 'in progress'
            ]);
        }

        // Periksa apakah ada level approval berikutnya
        $nextApprovalExists = Approval::where('booking_id', $booking->id)
            ->where('approval_level', $booking->current_approval_level + 1)
            ->where('status', 'pending')
            ->exists();

        if ($nextApprovalExists) {
            // Jika ada approval level berikutnya, perbarui current_approval_level
            $booking->update([
                'current_approval_level' => $booking->current_approval_level + 1
            ]);
        } else {
            // Jika tidak ada level approval berikutnya, periksa apakah semua approval disetujui
            $allApproved = Approval::where('booking_id', $booking->id)
                ->where('status', '!=', 'approved')
                ->doesntExist();

            if ($allApproved) {
                // Jika semua approval disetujui, perbarui overall status menjadi approved
                $booking->update([
                    'overall_approval_status' => 'approved',
                    'approval_status' => 'approved',
                ]);

                $this->moveToHistory($booking);
            } else {
                // Jika tidak, perbarui status menjadi in_progress
                $booking->update(['approval_status' => 'in progress']);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Approval status updated successfully.',
        ]);
    }

    public function reject($booking)
    {
        $booking = Booking::findOrFail($booking);

        return view('approvals.reject-action-modal', compact('booking'));
    }

    public function storeReject(Request $request, Booking $booking)
    {
        /** @var App\Models\User */
        $user = Auth::user();

        if (!$user->hasRole('approver')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak memiliki izin untuk approve atau reject.',
            ], 403);
        }

        $request->validate([
            'notes' => 'required|string|max:255',
        ]);

        // // Dapatkan approval untuk level yang dimaksud
        $approval = Approval::where('booking_id', $booking->id)
            ->where('approval_level', $booking->current_approval_level)
            ->where('user_id', $user->id)
            ->firstOrFail();

        if ($approval->status !== 'pending') {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda telah merespons tingkat persetujuan ini.'
            ], 400);
        }

        // Update status approval menjadi rejected
        $approval->update([
            'status' => 'rejected',
            'notes' => $request->notes,
            'approved_at' => now(),
        ]);

        // Update status approval level selanjutnya menjadi reject bila ada
        Approval::where('booking_id', $booking->id)
            ->where('approval_level', '>', $booking->current_approval_level)
            ->update([
                'status' => 'rejected',
                'notes' => 'Ditolak secara otomatis karena rejected pada tingkat sebelumnya.',
                'approved_at' => now(),
            ]);

        // // Perbarui status booking menjadi rejected jika sudah ditolak
        $booking->update([
            'overall_approval_status' => 'rejected',
            'approval_status' => 'rejected',
        ]);

        $bookingVehicle_Driver = Booking::findOrFail($approval->booking_id);
        if ($bookingVehicle_Driver && $bookingVehicle_Driver->vehicle_id) {
            $vehicle = Vehicle::findOrFail($booking->vehicle_id);
            if ($vehicle) {
                $vehicle->update([
                    'status' => 'tersedia'
                ]);
            }
        }

        if ($bookingVehicle_Driver && $bookingVehicle_Driver->driver_id) {
            $driver = Driver::findOrFail($booking->driver_id);
            if ($driver) {
                $driver->update([
                    'status' => 'tersedia'
                ]);
            }
        }

        $allRejected = Approval::where('booking_id', $booking->id)
            ->where('status', 'pending')
            ->doesntExist();

        if ($allRejected) {
            $this->moveToHistory($booking);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Rejection status updated successfully.',
        ]);

        // return redirect()->route('approvals.index')->with('message', 'Rejected Succesfully');
    }

    protected function moveToHistory(Booking $booking)
    {
        $vehicle = Vehicle::find($booking->vehicle_id);
        $driver = Driver::find($booking->driver_id);
        $user = User::find($booking->created_by);
        $bookingHistory = new BookingHistories();
        $bookingHistory->fill([
            'booking_id' => $booking->id,
            'user_id' => $booking->created_by,
            'user_name' => $user ? $user->name : null,
            'vehicle_id' => $booking->vehicle_id,
            'vehicle_name' => $vehicle ? $vehicle->name : null,
            'driver_id' => $booking->driver_id,
            'driver_name' => $driver ? $driver->name : null,
            'booking_number' => $booking->booking_number,
            'booking_name' => $booking->booking_name,
            'approval_status' => $booking->approval_status,
            'overall_approval_status' => $booking->overall_approval_status,
            'current_approval_level' => $booking->current_approval_level,
            'requested_at' => $booking->requested_at,
            'booking_date' => $booking->booking_date,
            'created_by' => $booking->created_by,
            'notes' => $booking->approvals()->pluck('notes')->implode(', '),
            'changed_at' => now()
        ]);
        $bookingHistory->save();

        $booking->delete();
    }
}