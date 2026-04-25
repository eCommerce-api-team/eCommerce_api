<?php

namespace App\Providers;

use App\Events\OrderPlaced;
use App\Listeners\SendOrderEmailListener;
use App\Listeners\SendWelcomeEmailListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderPlaced::class => [SendOrderEmailListener::class],
        Registered::class => [SendWelcomeEmailListener::class],
    ];
}
