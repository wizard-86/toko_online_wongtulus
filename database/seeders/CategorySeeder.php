<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'T-Shirt',
            'Hoodie',
            'Jacket',
            'Pants',
            'Shoes',
            'Accessories'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'description' => $category . ' Collection'
            ]);
        }
    }
}