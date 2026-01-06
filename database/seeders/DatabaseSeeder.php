<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = ['Electronics', 'Fashion', 'Home & Living', 'Beauty', 'Toys', 'Health', 'Sports', 'Automotive'];
        
        foreach ($categories as $categoryName) {
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'image' => 'https://placehold.co/100x100?text=' . $categoryName,
            ]);

            for ($i = 1; $i <= 10; $i++) {
                 Product::create([
                    'category_id' => $category->id,
                    'name' => $categoryName . ' Product ' . $i,
                    'slug' => \Illuminate\Support\Str::slug($categoryName . ' Product ' . $i . '-' . uniqid()),
                    'description' => 'This is a description for ' . $categoryName . ' Product ' . $i,
                    'price' => rand(100, 5000),
                    'original_price' => rand(5000, 10000),
                    'stock' => rand(10, 100),
                    'sold_count' => rand(0, 1000),
                    'rating' => rand(30, 50) / 10,
                    'image' => 'https://placehold.co/400x400?text=' . urlencode($categoryName . ' ' . $i),
                    'is_flash_sale' => rand(0, 10) > 8,
                ]);
            }
        }
    }
}
