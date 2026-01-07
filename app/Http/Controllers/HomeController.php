<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{

    public function index()
    {
        // Get featured categories for homepage (limit to 5)
        $featuredCategories = Category::featured()->take(5)->get();
        
        // Fallback: if no featured categories, get first 5
        if ($featuredCategories->isEmpty()) {
            $featuredCategories = Category::take(5)->get();
        }
        
        $categories = Category::all();
        $flashSaleProducts = Product::where('is_flash_sale', true)->take(6)->get();
        $dailyDiscoverProducts = Product::inRandomOrder()->take(12)->get();

        return view('welcome', compact('categories', 'featuredCategories', 'flashSaleProducts', 'dailyDiscoverProducts'));
    }

    public function products()
    {
        $products = Product::with('category')->paginate(20);
        $categories = Category::withCount('products')->get();
        
        return view('products.index', compact('products', 'categories'));
    }
}
