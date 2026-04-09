<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            CmsSeeder::class,
        ]);

        // Demo user account (for testing)
        User::firstOrCreate(
            ['email' => 'user@goodsshippers.com'],
            [
                'name'              => 'Demo User',
                'phone'             => '+8801711000000',
                'password'          => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
    }
}

