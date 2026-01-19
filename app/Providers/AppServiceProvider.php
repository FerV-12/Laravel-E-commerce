<?php

namespace App\Providers;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Observers\UserObserver;
use App\Observers\ProductObserver;
use App\Observers\OrderObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

     /**
      * Bootstrap any application services.
      */
     public function boot(): void
     {
        // Share cart count with all views so navbar can display live indicator
        View::composer('*', function ($view) {
            $count = 0;
            $wishlistCount = 0;
            if (auth()->check()) {
                $count = Cart::where('user_id', auth()->user()->id)->sum('quantity');
                $wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();
            }

            $view->with('cartCount', $count)->with('wishlistCount', $wishlistCount);

        });

        // Register model observers for automatic notifications
        User::observe(UserObserver::class);
        Product::observe(ProductObserver::class);
        Order::observe(OrderObserver::class);
    }
}
