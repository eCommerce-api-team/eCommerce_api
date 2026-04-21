<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use app\Events\OrderPlaced;

class SendOrderEmailListener implements shouldQueue
{
    public function handle(OrderPlaced $event): void
    {
        $order = $event->order;
        Log::info('Email sent of order id :'.$order->id);
    }
}
