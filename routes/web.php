<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Static pages
Route::get('/about',   [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Products — all handled by ProductController
Route::get('/products',           [ProductController::class, 'index'])->name('products.index');
Route::get('/products/plants',    [ProductController::class, 'plants'])->name('products.plants');
Route::get('/products/pots',      [ProductController::class, 'pots'])->name('products.pots');
Route::get('/products/ceramics',  [ProductController::class, 'ceramics'])->name('products.ceramics');
Route::get('/products/cement',    [ProductController::class, 'cement'])->name('products.cement');
Route::get('/products/mud',       [ProductController::class, 'mud'])->name('products.mud');
Route::get('/products/plastic',   [ProductController::class, 'plastic'])->name('products.plastic');

// Authenticated routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
