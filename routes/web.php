<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SettingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/bulk-action', function() { 
        return response()->json(['success' => true]); 
    })->name('products.bulk-action');
    
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    
    Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
    
    Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
    
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});

// Product Detail Route
Route::get('/product/{id}', function ($id) {
    return view('product-detail');
})->name('product.show');