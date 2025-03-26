<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Ensure students exist
      if (User::where('role', 'student')->count() === 0) {
        User::factory()->count(10)->create(['role' => 'student']);
    }

    // Ensure products exist
    if (Product::count() === 0) {
        Product::factory()->count(20)->create();
    }
    Wishlist::factory()->count(50)->create();

    }
}
