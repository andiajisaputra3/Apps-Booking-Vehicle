<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Mendapatkan semua notifikasi yang belum dibaca
    public function index()
    {
        // Mendapatkan notifikasi yang belum dibaca
        $notifications = auth()->user()->unreadNotifications;
        return response()->json($notifications);
    }

    // Menandai notifikasi sebagai dibaca
    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Semua notifikasi telah dibaca'
        // ]);
        return redirect()->back();
    }

    // Menghapus notifikasi
    public function destroy($id)
    {
        $notification = Auth::user()->notifications->find($id);

        if ($notification) {
            $notification->delete();
            return response()->json(['message' => 'Notification deleted.']);
        }

        return response()->json(['message' => 'Notification not found.'], 404);
    }
}
