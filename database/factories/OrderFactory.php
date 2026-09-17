<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'category_id' => Category::factory(),
            'total' => $this->faker->randomFloat(2, 20, 1000),
        ];
    }
}