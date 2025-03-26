<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> $this->faker->sentence(3),
            'slug' => $this->faker->sentence(3),

            'author'=> $this->faker->name(),
            'category_id' => Category::factory(),  // Randomly assign category via factory
              'user_id'=>null,
            'isbn'=>$this->faker->unique()->isbn13(),
            'language'=>$this->faker->randomElement(['English','Hindi']),
            'pages'=>$this->faker->numberBetween(100,1000),
            'description'=>$this->faker->paragraph(5),
            // 'thumbnail_img'=>$this->faker->imageUrl(200,300,'products'),
            'rating'=>$this->faker->randomFloat(2,0,5),
            'price'=>$this->faker->randomFloat(3,50,2000),
            'discount_price'=>$this->faker->optional()->randomFloat(2,1,50),
            'discount_type'=>$this->faker->optional()->randomElement(['percentage','fixed']),
            'stock' => $this->faker->numberBetween(0, 500),
            'min_qty' => 1,
            'is_featured' => $this->faker->boolean(),
            'is_published' => $this->faker->boolean(),
            'num_of_sales' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
