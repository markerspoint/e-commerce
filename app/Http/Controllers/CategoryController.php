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

    public function show(Request $request, $slug)
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

        if ($request->ajax()) {
            return response()->json([
                'header' => view('category.partials.header', [
                    'category' => $category, 
                    'categoryName' => $category->name
                ])->render(),
                'grid' => view('category.partials.grid', [
                    'products' => $category->products
                ])->render(),
                'title' => $category->name . ' - ShopLink',
                'slug' => $category->slug
            ]);
        }

        // Fetch all categories for navigation
        $categories = Category::all();

        return view('category.show', [
            'category' => $category,
            'categoryName' => $category->name,
            'products' => $category->products,
            'categories' => $categories // Pass all categories
        ]);
    }

    public function getProducts($slug)
    {
        $category = Category::where('slug', $slug)->with('products')->firstOrFail();
        
        return response()->json([
            'categoryName' => $category->name,
            'products' => $category->products,
            'slug' => $slug
        ]);
    }
}
