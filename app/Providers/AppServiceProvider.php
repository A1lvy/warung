<?php

namespace App\Providers;

use App\Services\CartService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Share cart total quantity across all views for navbar indicator
        View::composer('*', function ($view) {
            $raw = session()->get('cart', []);
            $count = empty($raw) ? 0 : app(CartService::class)->getTotalQuantity();
            $view->with('cartCount', $count);
        });
    }
}
