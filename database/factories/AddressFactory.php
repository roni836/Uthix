<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'student')->inRandomOrder()->first()->id ?? User::factory()->create(['role' => 'student'])->id,
            'name' => $this->faker->name,
            'phone' => $this->faker->numerify('##########'), 
            'alt_phone' => $this->faker->optional()->numerify('##########'),
            'address_type' => $this->faker->randomElement(['Home', 'Work', 'Other']),
            'landmark' => $this->faker->optional()->sentence(3),
            'street' => $this->faker->streetName,
            'area' => $this->faker->citySuffix,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'postal_code' => $this->faker->postcode,
            'country' => 'India',
            'is_default' => $this->faker->boolean(20), 
        ];
    }
}
