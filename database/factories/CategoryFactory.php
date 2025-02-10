<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     */
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'parent_category_id' => null, // You can adjust this to generate subcategories
            'cat_title' => $this->faker->word,
            'cat_slug' => $this->faker->sentence(3),
            'cat_image' => $this->faker->imageUrl(200, 200, 'categories', true),
            'cat_description' => $this->faker->paragraph(),
            'status' => $this->faker->boolean(),
        ];
    }
}
