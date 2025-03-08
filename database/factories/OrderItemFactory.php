<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();
        $quantity = $this->faker->numberBetween(1, 5);
        $price = $product->price; // Assuming your Product model has a 'price' attribute
        $total_price = $quantity * $price;

        return [
            'order_id' => Order::inRandomOrder()->first()->id ?? Order::factory()->create()->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $price,
            'total_price' => $total_price,
        ];
    }
}
