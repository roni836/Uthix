<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure orders exist
        if (Order::count() === 0) {
            throw new \Exception('No orders found. Please seed the orders first.');
        }

        // Ensure products exist
        if (Product::count() === 0) {
            throw new \Exception('No products found. Please seed the products first.');
        }

        // Generate order items
        OrderItem::factory()->count(100)->create();
    }
}
