<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VendorRegistrationController;
use App\Http\Controllers\VendorDashboardController;
use App\Http\Controllers\Admin\VendorApplicationController;
use App\Http\Controllers\Vendor\CommissionNegotiationController as VendorCommissionController;
use App\Http\Controllers\Admin\CommissionNegotiationController as AdminCommissionController;
use App\Http\Controllers\Auth\VendorAuthenticatedSessionController;
use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// ──────────────────────────────────────────────
// PUBLIC ROUTES
// ──────────────────────────────────────────────
Route::get('/',          [HomeController::class, 'index'])->name('home');
Route::get('/about',     [PageController::class, 'about'])->name('about');
Route::get('/services',  [PageController::class, 'services'])->name('services');
Route::get('/contact',   [PageController::class, 'contact'])->name('contact');
Route::post('/contact',  [ContactController::class, 'store'])->name('contact.store');

// Products — public browsing
Route::get('/products',          [ProductController::class, 'index'])->name('products.index');
Route::get('/products/plants',   [ProductController::class, 'plants'])->name('products.plants');
Route::get('/products/pots',     [ProductController::class, 'pots'])->name('products.pots');
Route::get('/products/ceramics', [ProductController::class, 'ceramics'])->name('products.ceramics');
Route::get('/products/cement',   [ProductController::class, 'cement'])->name('products.cement');
Route::get('/products/mud',      [ProductController::class, 'mud'])->name('products.mud');
Route::get('/products/plastic',  [ProductController::class, 'plastic'])->name('products.plastic');

// Product detail — public
Route::get('/products/{product}', [ProductController::class, 'show'])
     ->name('products.show');

// ──────────────────────────────────────────────
// CART — requires verified customer account
// ──────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/cart',               [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}',    [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/{cartItem}',  [CartController::class, 'update'])->name('cart.update');
});

// ──────────────────────────────────────────────
// PROFILE — requires login only (not verification)
// ──────────────────────────────────────────────
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ──────────────────────────────────────────────
// ORDERS + PAYMENTS — requires verified customer account
// ──────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/orders',                 [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create',          [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders',                [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/{order}/switch-to-cod', [OrderController::class, 'switchToCod'])->name('orders.switchToCod');

    Route::get('/payment/{order}/initiate',      [PaymentController::class, 'initiate'])->name('payment.initiate');
    Route::get('/payment/esewa/success',         [PaymentController::class, 'esewaSuccess'])->name('payment.esewa.success');
    Route::get('/payment/esewa/{order}/failure', [PaymentController::class, 'esewaFailure'])->name('payment.esewa.failure');
    Route::get('/payment/khalti/callback',       [PaymentController::class, 'khaltiCallback'])->name('payment.khalti.callback');
});

// ──────────────────────────────────────────────
// VENDOR REGISTRATION — public, creates account + pending application
// ──────────────────────────────────────────────
Route::get('/vendor/register',  [VendorRegistrationController::class, 'create'])->name('vendor.register');
Route::post('/vendor/register', [VendorRegistrationController::class, 'store'])->name('vendor.register.store');
Route::get('/vendor/register/check', [VendorRegistrationController::class, 'checkDuplicate'])->name('vendor.register.check');

// ──────────────────────────────────────────────
// VENDOR AUTH — completely separate from customer login
// ──────────────────────────────────────────────
// Deliberately NOT wrapped in 'guest' middleware — a customer (or vendor,
// or admin) who's already logged in should still be able to open this page
// to check status or switch into a separate vendor account, instead of
// being silently bounced back to their own dashboard.
Route::get('/vendor/login',  [VendorAuthenticatedSessionController::class, 'create'])->name('vendor.login');
Route::post('/vendor/login', [VendorAuthenticatedSessionController::class, 'store']);
Route::post('/vendor/logout', [VendorAuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')->name('vendor.logout');

// ──────────────────────────────────────────────
// VENDOR ROUTES — only approved vendors reach these.
// No 'verified' middleware here — vendors are identity-checked via
// PAN document review during admin approval, not email OTP.
// ──────────────────────────────────────────────
Route::middleware(['auth', 'vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');

    Route::post('/commission/propose',              [VendorCommissionController::class, 'propose'])->name('commission.propose');
    Route::post('/commission/{negotiation}/accept', [VendorCommissionController::class, 'accept'])->name('commission.accept');
    Route::post('/commission/{negotiation}/reject', [VendorCommissionController::class, 'reject'])->name('commission.reject');
});

// ──────────────────────────────────────────────
// ADMIN AUTH — completely separate, no public registration
// ──────────────────────────────────────────────
// Same reasoning as vendor login — no 'guest' middleware, so an already
// logged-in user of any role can still reach this page rather than being
// redirected away from it.
Route::get('/admin/login',  [AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AdminAuthenticatedSessionController::class, 'store']);
Route::post('/admin/logout', [AdminAuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')->name('admin.logout');

// ──────────────────────────────────────────────
// ADMIN ROUTES — no 'verified' middleware; admin accounts are
// created manually, not self-registered with an unverified email.
// ──────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/vendors',                    [VendorApplicationController::class, 'index'])->name('vendors.index');
    Route::post('/vendors/{vendor}/approve',  [VendorApplicationController::class, 'approve'])->name('vendors.approve');
    Route::post('/vendors/{vendor}/reject',   [VendorApplicationController::class, 'reject'])->name('vendors.reject');

    Route::get('/commission-negotiations',                        [AdminCommissionController::class, 'index'])->name('commission-negotiations.index');
    Route::post('/commission-negotiations/{negotiation}/accept',  [AdminCommissionController::class, 'accept'])->name('commission-negotiations.accept');
    Route::post('/commission-negotiations/{negotiation}/reject',  [AdminCommissionController::class, 'reject'])->name('commission-negotiations.reject');
    Route::post('/commission-negotiations/{negotiation}/counter', [AdminCommissionController::class, 'counter'])->name('commission-negotiations.counter');
});

require __DIR__ . '/auth.php';