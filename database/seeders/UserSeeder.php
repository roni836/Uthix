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
        // Creating specific roles with fixed credentials
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@demo.com',
            'role' => 'admin',
            'phone' => '9876543210',
            'is_verified' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Instructor User',
            'email' => 'instructor@demo.com',
            'role' => 'instructor',
            'phone' => '9876543211',
            'is_verified' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Seller User',
            'email' => 'seller@demo.com',
            'role' => 'seller',
            'phone' => '9876543212',
            'is_verified' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Student User',
            'email' => 'student@demo.com',
            'role' => 'student',
            'phone' => '9876543213',
            'is_verified' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        // Generating 50 random users using the factory
        User::factory()->count(50)->create();
    }
}
