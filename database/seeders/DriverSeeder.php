<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Driver::create([
            'name' => 'John Doe',
            'phone' => '081234567890',
            'status' => 'tersedia',
        ]);

        Driver::create([
            'name' => 'Jane Smith',
            'phone' => '081234567891',
            'status' => 'tersedia',
        ]);

        Driver::create([
            'name' => 'Alice Brown',
            'phone' => '081234567892',
            'status' => 'tersedia',
        ]);

        Driver::create([
            'name' => 'Bob White',
            'phone' => '081234567893',
            'status' => 'tersedia',
        ]);

        Driver::create([
            'name' => 'Charlie Black',
            'phone' => '081234567894',
            'status' => 'tersedia',
        ]);
    }
}