<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class GroceryCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Vegetable', 'slug' => 'vegetable', 'image' => null],
            ['name' => 'Snacks & Breads', 'slug' => 'snacks-breads', 'image' => null],
            ['name' => 'Fruits', 'slug' => 'fruits', 'image' => null],
            ['name' => 'Meat & Fish', 'slug' => 'meat-fish', 'image' => null],
            ['name' => 'Milk & Dairy', 'slug' => 'milk-dairy', 'image' => null],
        ];

        foreach ($categories as $catData) {
            $category = Category::firstOrCreate(
                ['slug' => $catData['slug']],
                ['name' => $catData['name'], 'image' => $catData['image']]
            );
            
            // Create some dummy products for each if none exist
            if ($category->products()->count() == 0) {
                for ($i = 1; $i <= 5; $i++) {
                    Product::create([
                        'category_id' => $category->id,
                        'name' => $catData['name'] . ' Product ' . $i,
                        'slug' => Str::slug($catData['name'] . ' Product ' . $i),
                        'description' => 'Fresh ' . $catData['name'],
                        'price' => rand(5, 50),
                        'original_price' => rand(55, 100),
                        'stock' => 100,
                        'sold_count' => rand(0, 500),
                        'rating' => 5.0,
                        'image' => '/placeholder.svg', // Local Placeholder
                        'is_flash_sale' => false
                    ]);
                }
            }
        }
    }
}
