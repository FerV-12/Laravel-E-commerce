<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminAccountController;

Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function(){

    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Admin accounts listing
    Route::get('accounts', [AccountController::class, 'index']);
    Route::get('accounts/create', [AdminAccountController::class, 'create'])->name('admin.accounts.create');
    Route::post('accounts/store', [AdminAccountController::class, 'store'])->name('admin.accounts.store');
    Route::delete('accounts/{id}', [AccountController::class, 'destroy'])->name('admin.accounts.destroy');
    
    Route:: resource('brands',BrandController::class);
    Route::get('brands/{id}/delete', [BrandController::class, 'destroy'])->name('brands.delete');

    Route:: resource('categories',CategoryController::class);
    Route::get('categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.delete');

    Route:: resource('products',ProductController::class);
    Route::get('products/{id}/delete', [ProductController::class, 'destroy'])->name('products.delete');

    // Orders (admin)
    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index']);
    Route::get('orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'show']);
    Route::delete('orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'destroy']);

    Route:: get('products/{id}/images',[ProductImageController::class, 'index']);
    Route:: get('products/{id}/images/create',[ProductImageController::class, 'create']);
    Route:: post('products/{id}/images',[ProductImageController::class, 'store']);
    Route:: get('products/{id}/images/{imageId}/delete', [ProductImageController::class, 'destroy']);
});
