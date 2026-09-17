<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    public function definition(): array
{
    return [
        'name'        => fake()->randomElement(['Wireless Headphones', 'Gaming Laptop', 'Smart Watch', 'Running Shoes', 'Coffee Maker', 'Bluetooth Speaker']),
        'description' => fake()->randomElement([
            'Features advanced technology, high performance, and ergonomic design.',
            'Built with premium materials ensuring long durability and optimal user experience.',
            'Compact design with smart energy saving and easy connectivity.',
            'Includes full warranty with high speed processing and modern style.'
        ]),
        'price'       => fake()->randomFloat(2, 50, 1500),
        'category_id' => \App\Models\Category::inRandomOrder()->first()?->id ?? \App\Models\Category::factory(),
    ];
}
}