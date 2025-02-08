<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password')
        ]);

        $superadmin->assignRole('superadmin');
        $superadmin->assignRole('manager');
        $superadmin->assignRole('supervisor');
        $superadmin->assignRole('approver');

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]);

        $admin->assignRole('admin');

        $manager = User::create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('password')
        ]);

        $manager->assignRole('manager');
        $manager->assignRole('approver');

        $supervisor = User::create([
            'name' => 'supervisor',
            'email' => 'supervisor@gmail.com',
            'password' => Hash::make('password')
        ]);

        $supervisor->assignRole('supervisor');
        $supervisor->assignRole('approver');
    }
}