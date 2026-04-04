<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckoutService
{
    public function checkout($productId)
    {
        $user = auth()->user();
    
        DB::transaction(function () use ($user, $productId) {
           
        $product = Product::lockForUpdate()->findOrFail($productId);
            if ($product->stock < 1 ){
                throw new Exception ('Out of stock');
            }

            $product->stock -=1;  
            $product->save();  

            if ($user->wallet < 100 ){
                throw new Exception ('Insufficient balance');
            }

            $user->wallet -=100;  
            $user->save(); 

            Order::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'amount' => 100
            ]);

            throw new Exception("Simulated Crash");
        });
    }
}
