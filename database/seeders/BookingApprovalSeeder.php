<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingApprovalSeeder extends Seeder
{
    public function run()
    {
        // Ambil data dari tabel users, vehicles, dan drivers
        $users = DB::table('users')->pluck('id')->toArray();
        $vehicles = DB::table('vehicles')->pluck('id')->toArray();
        $drivers = DB::table('drivers')->pluck('id')->toArray();
        $approvers = DB::table('users')->where('role', 'approver')->pluck('id')->toArray(); // User yang menyetujui

        // Pastikan data tersedia
        if (empty($users) || empty($vehicles) || empty($drivers) || empty($approvers)) {
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            // Tentukan tanggal booking secara acak di Februari
            $day = rand(1, 28);
            $bookingDate = Carbon::create(2025, 2, $day, rand(0, 23), rand(0, 59), rand(0, 59));

            // Pilih user, vehicle, dan driver secara acak
            $userId = $users[array_rand($users)];
            $vehicleId = $vehicles[array_rand($vehicles)];
            $driverId = $drivers[array_rand($drivers)];

            // Insert booking ke tabel bookings
            $bookingId = DB::table('bookings')->insertGetId([
                'booking_number' => 'BK-' . $bookingDate->format('YmdHis') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT),
                'booking_name' => 'Booking ' . ($i + 1),
                'vehicle_id' => $vehicleId,
                'driver_id' => $driverId,
                'approval_status' => 'pending', // Booking baru dibuat, otomatis pending
                'overall_approval_status' => 'pending',
                'current_approval_level' => 1,
                'requested_at' => $bookingDate,
                'booking_date' => $bookingDate,
                'created_by' => $userId,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Buat approvals untuk booking ini (misalnya ada 2 level)
            foreach (range(1, 2) as $level) {
                $approverId = $approvers[array_rand($approvers)];
                $status = ($level == 1) ? 'pending' : null; // Level 1 otomatis pending, level 2 menunggu persetujuan

                DB::table('approvals')->insert([
                    'booking_id' => $bookingId,
                    'user_id' => $approverId,
                    'approval_level' => $level,
                    'status' => $status,
                    'approval_role' => 'Approver Level ' . $level,
                    'approved_at' => null,
                    'notes' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}