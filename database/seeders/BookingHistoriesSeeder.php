<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingHistoriesSeeder extends Seeder
{
    public function run()
    {
        // Ambil data dari tabel users, vehicles, dan drivers
        $users = DB::table('users')->pluck('id', 'name')->toArray();
        $vehicles = DB::table('vehicles')->pluck('id', 'name')->toArray();
        $drivers = DB::table('drivers')->pluck('id', 'name')->toArray();

        // Pastikan data tersedia
        if (empty($users) || empty($vehicles) || empty($drivers)) {
            return;
        }

        // Jumlah booking per bulan (agar grafik naik turun)
        $monthlyBookings = [
            1 => rand(20, 50), // Januari
            2 => rand(10, 30), // Februari (lebih sedikit)
            3 => rand(40, 60), // Maret (lebih banyak)
            4 => rand(15, 45)  // April
        ];

        foreach ($monthlyBookings as $month => $totalBookings) {
            // Tentukan jumlah hari dalam bulan tersebut
            $daysInMonth = [
                1 => 31, // Januari
                2 => 28, // Februari
                3 => 31, // Maret
                4 => 30  // April
            ];

            for ($i = 0; $i < $totalBookings; $i++) {
                // Tentukan tanggal yang valid dalam bulan tersebut
                $day = rand(1, $daysInMonth[$month]);
                $bookingDate = Carbon::create(2025, $month, $day, rand(0, 23), rand(0, 59), rand(0, 59));

                // Pilih user, vehicle, dan driver secara acak
                $user = array_rand($users);
                $vehicle = array_rand($vehicles);
                $driver = array_rand($drivers);

                // Status approval dibuat acak agar seimbang
                $approvalStatuses = ['approved', 'rejected'];
                $overallApprovalStatuses = ['approved', 'rejected'];
                $approvalStatus = $approvalStatuses[array_rand($approvalStatuses)];
                $overallApprovalStatus = $overallApprovalStatuses[array_rand($overallApprovalStatuses)];

                DB::table('booking_histories')->insert([
                    'booking_id' => rand(1, 50), // Asumsikan ada booking_id antara 1-50
                    'user_id' => $users[$user],
                    'user_name' => $user,
                    'vehicle_id' => $vehicles[$vehicle],
                    'vehicle_name' => $vehicle,
                    'driver_id' => $drivers[$driver],
                    'driver_name' => $driver,
                    'booking_number' => 'BK-' . $bookingDate->format('YmdHis') . '-' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT),
                    'booking_name' => 'Booking ' . ($i + 1),
                    'approval_status' => $approvalStatus,
                    'overall_approval_status' => $overallApprovalStatus,
                    'current_approval_level' => rand(1, 2), // Misalnya ada 3 level approval
                    'requested_at' => $bookingDate->subDays(rand(1, 7)),
                    'booking_date' => $bookingDate,
                    'created_by' => $users[$user],
                    'notes' => rand(0, 1) ? 'Catatan approval ' . ($i + 1) : null,
                    'changed_at' => rand(0, 1) ? Carbon::now()->subDays(rand(1, 10)) : null,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}