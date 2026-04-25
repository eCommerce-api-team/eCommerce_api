<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\Variant;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Services\CartItemService;
use App\Http\Requests\CartItemRequest;
use App\Exceptions\NotEnoughBalanceException;

class CheckoutService
{
    public function __construct(public CartItemService $cartItemService)
    {
         $this->CartItemService = $cartItemService ;
    }
    public function checkout(CartItemRequest $request)
    {
        $cartItem = $this->cartItemService->userCart($request);
        $user = auth()->user();
        
        DB::transaction(function () use ($user ,$cartItem)
        {
        
        $wallet = Wallet::where('user_id', $user->id)->lockForUpdate()->first();
   
        $product = Product::with('variants')->lockForUpdate()->first();

        $variant = Variant::where('product_id',$product->id);

        $totalPrice = $cartItem->quantity * $product->base_price;

        if ($wallet?->balance < $totalPrice )
        {
            throw new NotEnoughBalanceException();
        }
        $wallet->decrement('balance',$totalPrice);  
        $product->decrement('stock' , $cartItem->quantity);  
        $variant->decrement('variant_stock' , $cartItem->quantity);  
    
        $order = Order::create
        ([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'total_amount' => $totalPrice,
            'status' => 'pending',
        ]);
            return $order;
        });
    }
}
