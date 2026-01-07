<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'products'])->name('products.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// API endpoint for AJAX category navigation
Route::get('/api/category/{slug}/products', [CategoryController::class, 'getProducts'])->name('api.category.products');


// Authentication Routes (Guest only)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout route (authenticated only)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Protected routes - require authentication
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add', function() { 
        return response()->json(['success' => true, 'message' => 'Product added to cart']); 
    })->name('cart.add');
    
    Route::get('/cart', function() { 
        return view('cart.index'); 
    })->name('cart.index');
    
    Route::get('/checkout', function() { 
        return view('checkout.index'); 
    })->name('checkout.index');
});

// Seller Routes - require seller role
Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
    
    // Products CRUD
    Route::get('/products', [SellerController::class, 'products'])->name('products');
    Route::get('/products/create', [SellerController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [SellerController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{product}/edit', [SellerController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{product}', [SellerController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [SellerController::class, 'deleteProduct'])->name('products.delete');
    
    // Categories CRUD
    Route::get('/categories', [SellerController::class, 'categories'])->name('categories');
    Route::get('/categories/create', [SellerController::class, 'createCategory'])->name('categories.create');
    Route::post('/categories', [SellerController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{category}/edit', [SellerController::class, 'editCategory'])->name('categories.edit');
    Route::put('/categories/{category}', [SellerController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [SellerController::class, 'deleteCategory'])->name('categories.delete');
});

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
