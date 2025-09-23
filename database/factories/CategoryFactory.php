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
            $title = $this->faker->words(3, true); 
    
            return [
                'parent_category_id' => Category::inRandomOrder()->value('id'),
                'cat_title' => $title,
                'cat_slug' => Str::slug($title), 
                'cat_image' => $this->faker->randomElement(['public/images/book.jpg']),
                'cat_description' => $this->faker->paragraph(),
                'status' => $this->faker->boolean(),
            ];
        }
   
}
