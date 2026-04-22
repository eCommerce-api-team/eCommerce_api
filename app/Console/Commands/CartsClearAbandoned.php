<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cart;
class CartsClearAbandoned extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carts:clear-abandoned';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear abandoned carts older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       $carts = Cart::where('updated_at','<', now()->subDays(30))->delete();
    }
}
