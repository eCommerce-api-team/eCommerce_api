<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\Variant;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckoutService
{
    public function checkout($productId)
    {
        $user = auth()->user();
    
        DB::transaction(function () use ($user, $productId) {
        
        $wallet = Wallet::where('user_id', $user?->id)->lockForUpdate()->first();
   
        $product = Variant::with('products')->lockForUpdate()->findOrFail($productId);

            if ($product->stock < 1 ){
                throw new Exception ('Out of stock');
            }
            if ($wallet?->balance < 100 ){
                throw new Exception ('Insufficient balance');
            }
            
            $wallet->decrement('balance',100);  
            $product->decrement('stock');  
     
            Order::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'amount' => 100
            ]);
        });
    }
}
