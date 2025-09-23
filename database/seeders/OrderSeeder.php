<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure users exist
        if (User::count() === 0) {
            User::factory()->count(10)->create();
        }

        // Ensure addresses exist
        if (Address::count() === 0) {
            Address::factory()->count(10)->create();
        }

        // Ensure coupons exist (optional)
        if (Coupon::count() === 0) {
            Coupon::factory()->count(5)->create();
        }

        // Generate orders
        Order::factory()->count(50)->create();
    }
}
