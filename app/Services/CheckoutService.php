<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Exceptions\OutOfStockException;
use App\Exceptions\NotEnoughBalanceException;

class CheckoutService
{
    public function checkout($productId , $amount)
    {
        $user = auth()->user();
    
        DB::transaction(function () use ($user, $productId , $amount) {
        
        $wallet = Wallet::where('user_id', $user?->id)->lockForUpdate()->first();
   
        $product = Product::with('variants')->lockForUpdate()->findOrFail($productId);

        $totalPrice = $amount * $product->base_price;

            if ($product->stock < $amount ){
                throw new OutOfStockException();
            }
            if ($wallet?->balance < $totalPrice ){
                throw new NotEnoughBalanceException();
            }
            
            $wallet->decrement('balance',$totalPrice);  
            $product->decrement('stock' , $amount);  
            $product->decrement('variant_stock' , $amount);  
     
            Order::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'total_amount' => $totalPrice
            ]);
        });
    }
}
