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
        // Admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'firstname' => 'Admin',
                'lastname' => 'User',
                'password' => Hash::make('password'),
                'mobile' => '9876543210',
            ]
        );

        $admin->assignRole('admin');

        // Normal user
        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'firstname' => 'Normal',
                'lastname' => 'User',
                'password' => Hash::make('password'),
                'mobile' => '8888888888',
            ]
        );

        $user->assignRole('user');
    }
}
