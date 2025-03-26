<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'seller')->inRandomOrder()->first()->id 
                ?? User::factory()->create(['role' => 'seller'])->id,

            'gender' => $this->faker->randomElement(['male', 'female', 'others']),
            'dob' => $this->faker->date('Y-m-d', '2000-01-01'),
            'address' => $this->faker->address,
            'store_name' => $this->faker->company,
            'store_address' => $this->faker->address,
            'logo' => $this->faker->optional()->imageUrl(200, 200, 'business'),
            'school' => $this->faker->optional()->company,
            'counter' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'isApproved' => $this->faker->boolean(70), // 70% chance of being approved
        ];
    }

}
