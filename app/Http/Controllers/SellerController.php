<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    /**
     * Show the seller dashboard with real stats.
     */
    public function dashboard()
    {
        $stats = [
            'totalProducts' => Product::count(),
            'totalStock' => Product::sum('stock'),
            'totalSold' => Product::sum('sold_count'),
            'lowStock' => Product::where('stock', '<', 10)->count(),
        ];

        $recentProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('seller.dashboard', compact('stats', 'recentProducts'));
    }

    /**
     * Show the products list.
     */
    public function products(Request $request)
    {
        $query = Product::with('category');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('seller.products.index', compact('products', 'categories'));
    }

    /**
     * Show the create product form.
     */
    public function createProduct()
    {
        $categories = Category::all();
        return view('seller.products.create', compact('categories'));
    }

    /**
     * Store a new product.
     */
    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_flash_sale' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . uniqid();
        $validated['is_flash_sale'] = $request->has('is_flash_sale');

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        Product::create($validated);

        return redirect()->route('seller.products')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the edit product form.
     */
    public function editProduct(Product $product)
    {
        $categories = Category::all();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    /**
     * Update a product.
     */
    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_flash_sale' => 'boolean',
        ]);

        $validated['is_flash_sale'] = $request->has('is_flash_sale');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->route('seller.products')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Delete a product.
     */
    public function deleteProduct(Product $product)
    {
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('seller.products')
            ->with('success', 'Product deleted successfully!');
    }

    /**
     * Show the categories list.
     */
    public function categories()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('seller.categories.index', compact('categories'));
    }

    /**
     * Show the create category form.
     */
    public function createCategory()
    {
        return view('seller.categories.create');
    }

    /**
     * Store a new category.
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'featured' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['featured'] = $request->has('featured');

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }

        Category::create($validated);

        return redirect()->route('seller.categories')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Show the edit category form.
     */
    public function editCategory(Category $category)
    {
        return view('seller.categories.edit', compact('category'));
    }

    /**
     * Update a category.
     */
    public function updateCategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'featured' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['featured'] = $request->has('featured');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }

        $category->update($validated);

        return redirect()->route('seller.categories')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Delete a category.
     */
    public function deleteCategory(Category $category)
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()->route('seller.categories')
                ->with('error', 'Cannot delete category with products. Please delete or move products first.');
        }

        // Delete image if exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('seller.categories')
            ->with('success', 'Category deleted successfully!');
    }
}
