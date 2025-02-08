<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use App\Notifications\BookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newOrder = Booking::orderBy('created_at', 'desc')->get();
        return view('booking.new-order.index', compact('newOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::where('status', 'tersedia')->get();
        $drivers = Driver::where('status', 'tersedia')->get();

        return view('booking.new-order.new-order-action', [
            'order' => new Booking(),
            'vehicles' => $vehicles,
            'selectedVehicleId' => null,
            'drivers' => $drivers,
            'selectedDriverId' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_name' => 'required|string|max:255',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'booking_date' => 'required|date|after_or_equal:today',
        ]);

        $bookingNumber = 'BK-' . now()->format('YmdHis') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);

        $booking = Booking::create([
            'booking_number' => $bookingNumber,
            'booking_name' => $request->booking_name,
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'booking_date' => $request->booking_date,
            'approval_status' => 'pending',
            'overall_approval_status' => 'pending',
            'current_approval_level' => 1,
            'requested_at' => now(),
            'created_by' => Auth::id(),
        ]);

        // Simpan data ke tabel approvals 
        Approval::insert([
            [
                'booking_id' => $booking->id,
                'user_id' => $this->getFirstApproverUserId('manager'),
                'approval_level' => 1,
                'status' => 'pending',
                'notes' => null,
                'approved_at' => null,
                'approval_role' => 'manager',
                'created_at' => now(),
            ],
            [
                'booking_id' => $booking->id,
                'user_id' => $this->getFirstApproverUserId('supervisor'),
                'approval_level' => 2,
                'status' => 'pending',
                'notes' => null,
                'approved_at' => null,
                'approval_role' => 'supervisor',
                'created_at' => now(),
            ],
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        if ($vehicle) {
            $vehicle->status = 'sedang digunakan';
            $vehicle->save();
        }

        $driver = Driver::findOrFail($request->driver_id);
        if ($driver) {
            $driver->status = 'tidak tersedia';
            $driver->save();
        }

        // Mengirim Notif Ke manager dan supervisor
        $this->sendBookingNotification($booking);

        return response()->json([
            'status' => 'success',
            'message' => 'Order Added Successfully and Notification sent.'
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::findOrFail($id);
        $driver = Driver::findOrFail($booking->driver_id);
        $vehicle = Vehicle::findOrFail($booking->vehicle_id);

        return view('booking.new-order.detail-order', compact('booking', 'driver', 'vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Booking::findOrFail($id);
        $vehicles = Vehicle::where('status', 'tersedia')->orWhere('id', $order->vehicle_id)->get();
        $drivers = Driver::where('status', 'tersedia')->orWhere('id', $order->driver_id)->get();

        return view('booking.new-order.new-order-action', [
            'order' => $order,
            'vehicles' => $vehicles,
            'selectedVehicleId' => $order->vehicle_id,
            'drivers' => $drivers,
            'selectedDriverId' => $order->driver_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Booking::findOrFail($id);

        $request->validate([
            'booking_name' => 'required|string|max:255',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'booking_date' => 'required|date|after_or_equal:today',
        ]);

        // Simpan `vehicle_id` dan `driver_id` lama sebelum pembaruan
        $previousVehicleId = $order->vehicle_id;
        $previousDriverId = $order->driver_id;

        $order->update([
            'booking_name' => $request->booking_name,
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'booking_date' => $request->booking_date,
        ]);

        // Jika kendaraan lama berbeda dengan kendaraan baru
        if ($previousVehicleId != $request->vehicle_id) {
            // merubah status kendaraan lama menjadi 'tersedia'
            $oldVehicle = Vehicle::findOrFail($previousVehicleId);
            if ($oldVehicle) {
                $oldVehicle->update([
                    'status' => 'tersedia'
                ]);
            }

            // merubah status kendaraan baru menjadi 'tidak tersedia'
            $newVehicle = Vehicle::findOrFail($request->vehicle_id);
            if ($newVehicle) {
                $newVehicle->update([
                    'status' => 'sedang digunakan'
                ]);
            }
        }

        // Jika driver lama berbeda dengan driver baru
        $oldDriver = Driver::find($previousDriverId);
        if ($oldDriver) {
            $oldDriver->update([
                'status' => 'tersedia'
            ]);
        }

        $newDriver = Driver::find($request->driver_id);
        if ($newDriver) {
            $newDriver->update([
                'status' => 'tidak tersedia'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Order Update Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Booking::findOrFail($id);
        $vehicleId = $order->vehicle_id;
        $driverId = $order->driver_id;

        $order->delete();

        $vehicle = Vehicle::findOrFail($vehicleId);
        if ($vehicle) {
            $vehicle->update([
                'status' => 'tersedia',
            ]);
        }

        $driver = Driver::findOrFail($driverId);
        if ($driver) {
            $driver->update([
                'status' => 'tersedia',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Order deleted successfully',
        ]);
    }

    protected function getFirstApproverUserId($role)
    {
        $user = \App\Models\User::role($role)->first(); // Mengambil user dengan role tertentu
        return $user ? $user->id : null;
    }

    protected function sendBookingNotification($booking)
    {
        $users = User::role(['manager', 'supervisor'])->get();

        foreach ($users as $user) {
            $user->notify(new BookingNotification($booking));
        }
    }
}
