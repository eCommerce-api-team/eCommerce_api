<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Variant;
use App\Observers\BaseObserver;
use App\Observers\OrderObserver;
use App\Observers\UserObserver;
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
