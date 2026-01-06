<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;

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
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/vegetable', [CategoryController::class, 'vegetable'])->name('category.vegetable');
Route::get('/category/snacks-breads', [CategoryController::class, 'snacksBreads'])->name('category.snacks-breads');
Route::get('/category/fruits', [CategoryController::class, 'fruits'])->name('category.fruits');
Route::get('/category/meat-fish', [CategoryController::class, 'meatFish'])->name('category.meat-fish');
Route::get('/category/milk-dairy', [CategoryController::class, 'milkDairy'])->name('category.milk-dairy');

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::post('/login', function() { return redirect('/'); }); // Placeholder post route
Route::post('/register', function() { return redirect('/'); }); // Placeholder post route

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
