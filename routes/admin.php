<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

use App\Http\Controllers\Admin\{
    BrandController,
    ProductController,
    CategoryController,
    DashboardController,
    ProductImageController,
    AccountController,
    AdminAccountController,
    SettingsController,
    OrderController
};

Route::prefix('admin')
    ->middleware(['auth', AdminMiddleware::class])
    ->name('admin.')
    ->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Accounts
    Route::get('accounts', [AccountController::class, 'index'])->name('accounts.index');
    Route::get('accounts/create', [AdminAccountController::class, 'create'])->name('accounts.create');
    Route::post('accounts/store', [AdminAccountController::class, 'store'])->name('accounts.store');
    Route::delete('accounts/{id}', [AccountController::class, 'destroy'])->name('accounts.destroy');

    // Resources
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // Product Images
    Route::get('products/{id}/images', [ProductImageController::class, 'index']);
    Route::get('products/{id}/images/create', [ProductImageController::class, 'create']);
    Route::post('products/{id}/images', [ProductImageController::class, 'store']);
    Route::get('products/{id}/images/{imageId}/delete', [ProductImageController::class, 'destroy']);

    // Admin Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('settings/update', [SettingsController::class, 'update'])->name('settings.update');
});
