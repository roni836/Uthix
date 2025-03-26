<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'address_id' => Address::inRandomOrder()->first()->id ?? null, // Sometimes null if no addresses exist
            'order_number' => strtoupper(Str::random(10)), // Generate a random order number
            'is_ordered' => $this->faker->boolean(80), // 80% chance it's ordered
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'canceled']),
            'total_amount' => $this->faker->randomFloat(2, 100, 10000), // Random amount between 100 and 10,000
            'shipping_charge' => $this->faker->randomFloat(2, 0, 500), // Random shipping charge between 0 and 500
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid', 'refunded']),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'cod', 'bank_transfer', null]),
            'tracking_number' => $this->faker->optional()->regexify('[A-Z0-9]{12}'), // Optional 12-character tracking number
            'coupon_id' => Coupon::inRandomOrder()->first()->id ?? null, // Use existing coupon or null
        ];
    }
}
