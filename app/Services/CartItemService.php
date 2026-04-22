<?php

namespace App\Services;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Http\Requests\CartItemRequest;
use Exception;
use App\Exceptions\OutOfStockException;

class CartItemService
{
    public function userCart(CartItemRequest $request)
    {
        $user = auth()->user();
        if (!$user)
        {
            throw new Exception('Register first');
        }

        $userCart = Cart::create(['user_id'=>$user->id]);
        
        $cartItem = CartItem::create([
            'cart_id' =>$userCart->id,
            'variant_id' =>$request->variant_id,
            'quantity' =>$request->quantity,
        ]);
        
        $cartItem->load('variant');
       
        if ($cartItem->quantity > $cartItem->variant->variant_stock)
        {
             throw new OutOfStockException();
        }
        return $cartItem;
    }
}
