<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsUser;

use App\Http\Controllers\User\{
    UserDashboardController,
    ProductController,
    CartController,
    WishlistController,
    CheckoutController,
    SettingsController
};

Route::prefix('user')
    ->middleware(['auth', IsUser::class])
    ->name('user.')
    ->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('dashboard', [UserDashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Products
    |--------------------------------------------------------------------------
    */
    Route::resource('products', ProductController::class);

    /*
    |--------------------------------------------------------------------------
    | Cart  ✅ COMPLETE (NO MISSING ROUTES)
    |--------------------------------------------------------------------------
    */
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');

    /*
    |--------------------------------------------------------------------------
    | Wishlist
    |--------------------------------------------------------------------------
    */
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::post('wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');

    /*
    |--------------------------------------------------------------------------
    | Checkout
    |--------------------------------------------------------------------------
    */
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout/place', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
    Route::get('checkout/thankyou', [CheckoutController::class, 'thankYou'])->name('checkout.thankyou');

    /*
    |--------------------------------------------------------------------------
    | User Settings
    |--------------------------------------------------------------------------
    */
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('settings/update', [SettingsController::class, 'update'])->name('settings.update');


});
