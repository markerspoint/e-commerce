<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return view('category.index', compact('categories'));
    }

    public function vegetable()
    {
        $category = Category::where('slug', 'vegetable')->with('products')->firstOrFail();
        return view('category.vegetable', [
            'category' => $category,
            'categoryName' => $category->name,
            'products' => $category->products
        ]);
    }

    public function snacksBreads()
    {
        $category = Category::where('slug', 'snacks-breads')->with('products')->firstOrFail();
        return view('category.snacks-breads', [
            'category' => $category,
            'categoryName' => $category->name,
            'products' => $category->products
        ]);
    }

    public function fruits()
    {
        $category = Category::where('slug', 'fruits')->with('products')->firstOrFail();
        return view('category.fruits', [
            'category' => $category,
            'categoryName' => $category->name,
            'products' => $category->products
        ]);
    }

    public function meatFish()
    {
        $category = Category::where('slug', 'meat-fish')->with('products')->firstOrFail();
        return view('category.meat-fish', [
            'category' => $category,
            'categoryName' => $category->name,
            'products' => $category->products
        ]);
    }

    public function milkDairy()
    {
        $category = Category::where('slug', 'milk-dairy')->with('products')->firstOrFail();
        return view('category.milk-dairy', [
            'category' => $category,
            'categoryName' => $category->name,
            'products' => $category->products
        ]);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->with('products')->firstOrFail();
        
        $viewName = 'category.' . $slug;
        if (view()->exists($viewName)) {
            return view($viewName, [
                'category' => $category,
                'categoryName' => $category->name,
                'products' => $category->products
            ]);
        }

        return view('category.show', [
            'category' => $category,
            'categoryName' => $category->name,
            'products' => $category->products
        ]);
    }
}
