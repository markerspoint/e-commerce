<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $flashSaleProducts = Product::where('is_flash_sale', true)->take(6)->get();
        $dailyDiscoverProducts = Product::inRandomOrder()->take(12)->get();

        return view('welcome', compact('categories', 'flashSaleProducts', 'dailyDiscoverProducts'));
    }
}
