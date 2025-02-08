<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'name' => 'Honda Civic',
            'plate_number' => 'B 1234 ABC',
            'status' => 'tersedia',
        ]);

        Vehicle::create([
            'name' => 'Toyota Corolla',
            'plate_number' => 'B 2345 DEF',
            'status' => 'tersedia',
        ]);

        Vehicle::create([
            'name' => 'Nissan Altima',
            'plate_number' => 'B 3456 GHI',
            'status' => 'tersedia',
        ]);

        Vehicle::create([
            'name' => 'BMW 320i',
            'plate_number' => 'B 4567 JKL',
            'status' => 'perbaikan',
        ]);

        Vehicle::create([
            'name' => 'Ford Mustang',
            'plate_number' => 'B 5678 MNO',
            'status' => 'tersedia',
        ]);
    }
}
