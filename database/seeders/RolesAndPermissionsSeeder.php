<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'manage-users',
            'manage-orders',
            'manage-parcels',
            'manage-shipments',
            'manage-invoices',
            'manage-tickets',
            'manage-warehouses',
            'manage-cms',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->syncPermissions($permissions);

        $operationsStaff = Role::firstOrCreate(['name' => 'operations_staff']);
        $operationsStaff->syncPermissions([
            'manage-orders',
            'manage-parcels',
            'manage-shipments',
            'manage-invoices',
            'manage-tickets',
        ]);

        // Create default super admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@goosshippers.com'],
            [
                'name'               => 'Super Admin',
                'password'           => Hash::make('password'),
                'warehouse_suite_id' => 'BD-0001',
                'email_verified_at'  => now(),
                'status'             => 'active',
            ]
        );

        $admin->assignRole('super_admin');
    }
}
