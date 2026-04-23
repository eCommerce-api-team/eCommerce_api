<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\OrderPlaced;
use App\Listeners\SendOrderEmailListener;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendWelcomeEmailListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderPlaced::class => [SendOrderEmailListener::class],
        Registered::class => [SendWelcomeEmailListener::class]
    ];
    
}
