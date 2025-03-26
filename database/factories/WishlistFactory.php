<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wishlist>
 */
class WishlistFactory extends Factory
{
    protected $model = Wishlist::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'student')->inRandomOrder()->first()->id ?? User::factory()->create(['role' => 'student'])->id,
       'product_id' => Product::inRandomOrder()->first()->id 
                ?? throw new \Exception('No products found in the database. Please seed the products first.'),        ];

    }
}
