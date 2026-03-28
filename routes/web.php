<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
// Public routes
Route::get('/',         [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about',    [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/contact',  [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Products — public browsing
Route::get('/products',          [ProductController::class, 'index'])->name('products.index');
Route::get('/products/plants',   [ProductController::class, 'plants'])->name('products.plants');
Route::get('/products/pots',     [ProductController::class, 'pots'])->name('products.pots');
Route::get('/products/ceramics', [ProductController::class, 'ceramics'])->name('products.ceramics');
Route::get('/products/cement',   [ProductController::class, 'cement'])->name('products.cement');
Route::get('/products/mud',      [ProductController::class, 'mud'])->name('products.mud');
Route::get('/products/plastic',  [ProductController::class, 'plastic'])->name('products.plastic');

// Product detail — auth required
Route::get('/products/{product}', [ProductController::class, 'show'])
     ->name('products.show')
     ->middleware('auth');

// Cart — auth required
Route::middleware('auth')->group(function () {
    Route::get('/cart',                    [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}',         [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{cartItem}',      [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/{cartItem}',       [CartController::class, 'update'])->name('cart.update');
});

// Profile
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Order routes
Route::middleware('auth')->group(function () {
    Route::get('/orders',              [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create',       [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders',             [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});

require __DIR__ . '/auth.php';