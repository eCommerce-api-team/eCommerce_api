<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Variant;
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
        Category::observe(BaseObserver::class);
        Product::observe(BaseObserver::class);
        Variant::observe(BaseObserver::class);
        User::observe(UserObserver::class);
        Order::observe(OrderObserver::class);
    }
}
