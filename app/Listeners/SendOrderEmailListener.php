<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendOrderEmailListener implements ShouldQueue
{
    public function handle(OrderPlaced $event): void
    {
        $order = $event->order;
        Log::info('Email sent of order id :'.$order->id);
    }
}
