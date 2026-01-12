<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BrandController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\ProductImageController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Middleware\IsUser;

    Route::prefix('user')->middleware(['auth', IsUser::class])->group(function(){

    // Dashboard
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    
    // Brands
    Route::resource('brands', BrandController::class);
    Route::get('brands/{id}/delete', [BrandController::class, 'destroy'])->name('brands.delete');

    // Categories
    Route::resource('categories', CategoryController::class);   
    Route::get('categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.delete');

    // Products
    Route::resource('products', ProductController::class);
    Route::get('products/{id}/delete', [ProductController::class, 'destroy'])->name('products.delete');

    // Product Images
    Route::get('products/{id}/images', [ProductImageController::class, 'index']);
    Route::get('products/{id}/images/create', [ProductImageController::class, 'create']);
    Route::post('products/{id}/images', [ProductImageController::class, 'store']);
    Route::get('products/{id}/images/{imageId}/delete', [ProductImageController::class, 'destroy']);

    // ================= Cart =================
    // Show cart page
    Route::get('cart', [CartController::class, 'index'])->name('user.cart.index');

    // Add to cart
    Route::post('cart/add', [CartController::class, 'add'])->name('user.cart.add');

    // Optionally, remove item from cart
    Route::post('cart/remove', [CartController::class, 'remove'])->name('user.cart.remove');

    // Wishlist
    Route::get('wishlist', [WishlistController::class, 'index'])->name('user.wishlist.index');
    Route::post('wishlist/toggle', [WishlistController::class, 'toggle'])->name('user.wishlist.toggle');
    Route::post('wishlist/remove', [WishlistController::class, 'remove'])->name('user.wishlist.remove');

    // ================= Checkout =================
    Route::get('checkout', [\App\Http\Controllers\User\CheckoutController::class, 'index'])->name('user.checkout.index');
    Route::post('checkout/place', [\App\Http\Controllers\User\CheckoutController::class, 'placeOrder'])->name('user.checkout.place');
    Route::get('checkout/thankyou', [\App\Http\Controllers\User\CheckoutController::class, 'thankYou'])->name('user.checkout.thankyou');

    
});
