<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'read']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'delete']);

        Permission::create(['name' => 'approve']);
        Permission::create(['name' => 'view reports']);

        Role::create(['name' => 'approver']);
        Role::create(['name' => 'ceo']);

        $superadmin = Role::create(['name' => 'superadmin']);
        $superadmin->givePermissionTo(['create', 'read', 'update', 'delete', 'view reports']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(['create', 'read', 'update', 'delete', 'view reports']);

        $manager = Role::create(['name' => 'manager', 'approval_level' => 1]);
        $manager->givePermissionTo(['approve']);

        $supervisor = Role::create(['name' => 'supervisor', 'approval_level' => 2]);
        $supervisor->givePermissionTo(['approve']);
    }
}
