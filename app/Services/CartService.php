<?php

namespace App\Services;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Http\Requests\CartItemRequest;
use Exception;
use App\Exceptions\OutOfStockException;
class CartService
{
    public function userCart(CartItemRequest $request)
    {
        $user = auth()->user();
        if (!$user)
        {
            throw new Exception('Register first');
        }
       
        $userCart = Cart::create(['user_id'=>$user->id]);
        
        CartItem::create([
            'cart_id' =>$userCart->id,
            'variant_id' =>$request->product,
            'quantity' =>$request->quantity,
        ]);
        
        $cartItem =CartItem::with('variants')->first();

        if ($cartItem->quantity > $cartItem->variant_stock)
        {
             throw new OutOfStockException();
        }
    }
}
