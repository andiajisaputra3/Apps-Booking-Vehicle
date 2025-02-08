<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingHistories;

class BookingHistoriesController extends Controller
{
    public function index()
    {
        $histories = BookingHistories::orderBy('created_at', 'desc')->get();

        // Debug hasil relasi
        return view('booking.history.index', compact('histories'));
    }

    public function destroy(string $id)
    {
        $histories = BookingHistories::findOrFail($id);

        $histories->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'History deleted successfully',
        ]);
    }
}
