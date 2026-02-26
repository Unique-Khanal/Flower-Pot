<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/pots', [ProductController::class, 'pots'])->name('products.pots');
Route::get('/products/pots/ceramics', [ProductController::class, 'ceramics'])->name('products.ceramics');
Route::get('/products/pots/cement', [ProductController::class, 'cement'])->name('products.cement');
Route::get('/products/pots/mud', [ProductController::class, 'mud'])->name('products.mud');
Route::get('/products/pots/plastic', [ProductController::class, 'plastic'])->name('products.plastic');
Route::get('/products/plants', [ProductController::class, 'plants'])->name('products.plants');
