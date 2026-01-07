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
        $dailyDiscoverProducts = Product::inRandomOrder()->take(15)->get();

        return view('welcome', compact('categories', 'featuredCategories', 'flashSaleProducts', 'dailyDiscoverProducts'));
    }

    public function products(Request $request)
    {
        // Build query with optional category filter
        $query = Product::with('category');
        
        $selectedCategory = null;
        if ($request->has('category') && $request->category) {
            $selectedCategory = Category::where('slug', $request->category)->first();
            if ($selectedCategory) {
                $query->where('category_id', $selectedCategory->id);
            }
        }
        
        $products = $query->paginate(12);
        $categories = Category::withCount('products')->get();
        
        // Return JSON for AJAX requests (infinite scroll or category filtering)
        if ($request->ajax()) {
            $html = '';
            foreach ($products as $product) {
                $html .= view('products.partials.card', compact('product'))->render();
            }
            
            return response()->json([
                'html' => $html,
                'nextPage' => $products->hasMorePages() ? $products->currentPage() + 1 : null,
                'total' => $products->total(),
                'category' => $selectedCategory ? $selectedCategory->slug : null,
            ]);
        }
        
        return view('products.index', compact('products', 'categories', 'selectedCategory'));
    }
}
