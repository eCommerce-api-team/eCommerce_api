<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\OrderPlaced;
use App\Listeners\SendOrderEmailListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderPlaced::class => [SendOrderEmailListener::class]
    ];
}
