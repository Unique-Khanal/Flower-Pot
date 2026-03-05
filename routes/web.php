<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');

/**
 * Products main page
 */
Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

/**
 * Product categories (view-based)
 * This will cover routes like:
 * - products.plants
 * - products.pots
 * - products.cement
 * - products.ceramics
 * - products.mud
 * - products.plastic
 */
Route::prefix('products')->name('products.')->group(function () {
    $categories = [
        'plants',
        'pots',
        'cement',
        'ceramics',
        'mud',
        'plastic',
    ];

    foreach ($categories as $cat) {
        Route::get("/{$cat}", function () use ($cat) {
            // view path: resources/views/products/{cat}.blade.php
            // pass empty $products for now so the view won't crash if it expects it
            $products = [];

            return view("products.{$cat}", compact('products'));
        })->name($cat);
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';