<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'category_id' => 1,
                'name' => 'Basic White T-Shirt',
                'description' => 'Premium Cotton T-Shirt',
                'price' => 120000,
                'stock' => 30,
                'image' => 'products/tshirt1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'name' => 'Oversize Hoodie',
                'description' => 'Comfort Hoodie',
                'price' => 280000,
                'stock' => 15,
                'image' => 'products/hoodie1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'name' => 'Bomber Jacket',
                'description' => 'Streetwear Jacket',
                'price' => 350000,
                'stock' => 10,
                'image' => 'products/jacket1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 4,
                'name' => 'Cargo Pants',
                'description' => 'Slim Fit Cargo',
                'price' => 275000,
                'stock' => 20,
                'image' => 'products/pants1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 5,
                'name' => 'Sneakers',
                'description' => 'Casual Sneakers',
                'price' => 450000,
                'stock' => 12,
                'image' => 'products/shoes1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 6,
                'name' => 'Canvas Tote Bag',
                'description' => 'Fashion Tote Bag',
                'price' => 90000,
                'stock' => 40,
                'image' => 'products/bag1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}