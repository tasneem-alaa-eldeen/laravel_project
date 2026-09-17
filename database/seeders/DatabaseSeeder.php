<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categoriesData = [
            'Electronics' => [
                ['name' => 'Gaming Laptop', 'desc' => 'High performance laptop with RTX graphics.', 'price' => 1200],
                ['name' => 'Wireless Headphones', 'desc' => 'Noise-canceling over-ear headphones.', 'price' => 150],
                ['name' => 'Smart Watch', 'desc' => 'Fitness tracker with heart rate monitor.', 'price' => 200],
                ['name' => '4K Monitor', 'desc' => 'Ultra HD 27-inch display for creative work.', 'price' => 350],
            ],
            'Clothing' => [
                ['name' => 'Cotton T-Shirt', 'desc' => '100% pure organic cotton shirt.', 'price' => 25],
                ['name' => 'Denim Jacket', 'desc' => 'Classic blue denim jacket for winter.', 'price' => 85],
                ['name' => 'Leather Shoes', 'desc' => 'Elegant formal shoes made from genuine leather.', 'price' => 110],
            ],
            'Beauty & Care' => [
                ['name' => 'Skin Moisturizer', 'desc' => 'Hydrating cream for daily facial care.', 'price' => 35],
                ['name' => 'Perfume Spray', 'desc' => 'Long-lasting floral fragrance scent.', 'price' => 60],
            ],
        ];

        $statuses = ['Completed', 'Pending', 'Processing', 'Shipped', 'Delivered'];
        $statusIndex = 0;

        foreach ($categoriesData as $catName => $products) {
            $category = Category::create([
                'name' => $catName,
                'description' => "Explore our exclusive collection of {$catName} items."
            ]);

            foreach ($products as $p) {
                $product = Product::create([
                    'category_id' => $category->id,
                    'name' => $p['name'],
                    'description' => $p['desc'],
                    'price' => $p['price'],
                ]);

                Order::create([
                    'customer_name' => fake()->unique()->name(),
                    'status' => $statuses[$statusIndex % count($statuses)],
                    'product_id' => $product->id,
                    'category_id' => $category->id,
                    'total' => $product->price,
                ]);

                $statusIndex++;
            }
        }
    }
}