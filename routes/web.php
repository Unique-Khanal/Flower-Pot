<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

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
    Route::post('/orders/{order}/switch-to-cod', [OrderController::class, 'switchToCod'])->name('orders.switchToCod');

    Route::get('/payment/{order}/initiate', [PaymentController::class, 'initiate'])->name('payment.initiate');
    Route::get('/payment/esewa/success',    [PaymentController::class, 'esewaSuccess'])->name('payment.esewa.success');
    Route::get('/payment/esewa/{order}/failure', [PaymentController::class, 'esewaFailure'])->name('payment.esewa.failure');
    Route::get('/payment/khalti/callback',  [PaymentController::class, 'khaltiCallback'])->name('payment.khalti.callback');
});

// ──────────────────────────────────────────────
// VENDOR ROUTES (new — placeholder group)
// ──────────────────────────────────────────────
Route::middleware(['auth', 'vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    // Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');
    // Route::resource('/products', VendorProductController::class);
    // Route::get('/orders', [VendorOrderController::class, 'index'])->name('orders.index');
    // Route::get('/payouts', [VendorPayoutController::class, 'index'])->name('payouts.index');
});

// ──────────────────────────────────────────────
// ADMIN ROUTES (new — placeholder group)
// ──────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route::get('/vendors', [AdminVendorController::class, 'index'])->name('vendors.index');
    // Route::post('/vendors/{vendor}/approve', [AdminVendorController::class, 'approve'])->name('vendors.approve');
    // Route::post('/vendors/{vendor}/reject', [AdminVendorController::class, 'reject'])->name('vendors.reject');
});

require __DIR__ . '/auth.php';