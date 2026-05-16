<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProfileController;

// Client Routes (Public)
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Product Routes (Public)
Route::get('/products', [App\Http\Controllers\Client\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [App\Http\Controllers\Client\ProductController::class, 'show'])->name('products.show');

// API Routes for AJAX (Public)
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/products', [App\Http\Controllers\Client\ProductController::class, 'apiIndex'])->name('products.index');
    Route::get('/products/{id}', [App\Http\Controllers\Client\ProductController::class, 'apiShow'])->name('products.show');
    Route::get('/categories', [App\Http\Controllers\Client\ProductController::class, 'apiCategories'])->name('categories');
    
    // Cart API
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
});

// Checkout Routes (Public - can be guest or authenticated)
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/orders/confirmation/{orderNumber}', [App\Http\Controllers\CheckoutController::class, 'confirmation'])->name('orders.confirmation');

// Order Tracking (Guest)
Route::get('/track-order', function () {
    return view('client.orders.track-form');
})->name('orders.track.form');
Route::post('/track-order', [App\Http\Controllers\Client\OrderController::class, 'track'])->name('orders.track');

// Client Orders (Authenticated - Client Role)
Route::middleware(['auth', 'role:client'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');
    
    // Orders
    Route::get('/my-orders', [App\Http\Controllers\Client\OrderController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{orderNumber}', [App\Http\Controllers\Client\OrderController::class, 'show'])->name('orders.show');
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes (Authenticated - Admin Role Only)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/subcategories/{categoryId}', [ProductController::class, 'getSubcategories'])->name('products.subcategories');
    Route::post('/products/bulk-action', function() { 
        return response()->json(['success' => true]); 
    })->name('products.bulk-action');
    
    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    // Subcategories
    Route::post('/categories/{categoryId}/subcategories', [CategoryController::class, 'storeSubcategory'])->name('categories.subcategories.store');
    Route::put('/categories/{categoryId}/subcategories/{subcategoryId}', [CategoryController::class, 'updateSubcategory'])->name('categories.subcategories.update');
    Route::delete('/categories/{categoryId}/subcategories/{subcategoryId}', [CategoryController::class, 'destroySubcategory'])->name('categories.subcategories.destroy');
    
    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/orders/{id}/payment-status', [OrderController::class, 'updatePaymentStatus'])->name('orders.update-payment-status');
    Route::post('/orders/{id}/notes', [OrderController::class, 'addNotes'])->name('orders.add-notes');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    
    // Offers
    Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
    Route::get('/offers/create', [OfferController::class, 'create'])->name('offers.create');
    Route::post('/offers', [OfferController::class, 'store'])->name('offers.store');
    Route::get('/offers/{id}/edit', [OfferController::class, 'edit'])->name('offers.edit');
    Route::put('/offers/{id}', [OfferController::class, 'update'])->name('offers.update');
    Route::delete('/offers/{id}', [OfferController::class, 'destroy'])->name('offers.destroy');
    Route::post('/offers/{id}/toggle-status', [OfferController::class, 'toggleStatus'])->name('offers.toggle-status');
    
    // Sections
    Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});

// Authentication Routes (Breeze)
require __DIR__.'/auth.php';
