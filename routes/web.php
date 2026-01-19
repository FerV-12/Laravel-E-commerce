<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\PreorderController;
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Dashboard Redirect (Role-based)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect('/admin/dashboard')
            : redirect('/user/dashboard');
    }
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile (Shared)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Static Pages
|--------------------------------------------------------------------------
*/

Route::get('/privacy-policy', fn () => view('privacy-policy'));
Route::get('/terms-and-conditions', fn () => view('terms-and-conditions'));

/*
|--------------------------------------------------------------------------
| Other Route Files
|--------------------------------------------------------------------------
*/


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/preorders', [App\Http\Controllers\Admin\PreorderController::class, 'index'])
        ->name('admin.preorders.index');
});



require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';
