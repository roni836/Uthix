<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $discountType = $this->faker->randomElement(['percentage', 'fixed', 'freeShipping']);

        return [
            'code' => strtoupper(Str::random(10)), // Random 10-character uppercase string
            'discount_type' => $discountType,
            'discount_value' => $discountType === 'freeShipping' ? null : $this->faker->randomFloat(2, 5, 50), // Discount value only for 'percentage' or 'fixed'
            'expiration_date' => $this->faker->optional(0.8)->dateTimeBetween('+1 week', '+6 months'), // 80% chance of having an expiration date
            'status' => $this->faker->boolean(80), // 80% active coupons
        ];
    }
}
