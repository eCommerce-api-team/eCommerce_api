<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderPlaced;
use Illuminate\Support\Facades\Log;

class SendOrderEmailListener implements ShouldQueue
{
    public function handle(OrderPlaced $event): void
    {
        $order = $event->order;
        Log::info('Email sent of order id :'.$order->id);
    }
}
