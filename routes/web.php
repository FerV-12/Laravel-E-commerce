<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\User\CartController;


Route::get('/',[FrontendController::class,'index']);

Route::get('/dashboard', function () {
    // Redirect the generic dashboard route to the appropriate role dashboard.
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect('/admin/dashboard')
            : redirect('/user/dashboard');
    }

    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('user/cart', [CartController::class, 'index'])->name('user.cart.index');
    Route::post('user/cart/add', [CartController::class, 'add'])->name('user.cart.add');
    // Allow GET access to the add URL to redirect users who open the POST-only URL in the browser.
    Route::get('user/cart/add', function () {
        return redirect()->route('user.cart.index');
    })->name('user.cart.add.get');
    Route::post('user/cart/remove', [CartController::class, 'remove'])->name('user.cart.remove');
    Route::post('user/cart/update', [CartController::class, 'update'])->name('user.cart.update');


});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';

