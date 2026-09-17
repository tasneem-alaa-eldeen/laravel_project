<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
{
    return [
        'name'        => fake()->unique()->randomElement(['Electronics', 'Clothing', 'Books', 'Home & Kitchen', 'Sports', 'Beauty']),
        'description' => fake()->randomElement([
            'High quality items selected for daily use and top efficiency.',
            'Explore our wide selection of modern products and top accessories.',
            'Discover durable, highly rated products tailored for your needs.',
            'Premium quality items with exclusive discounts and long warranty.'
        ]),
    ];
}
}