<?php

namespace App\Services;

use App\Exceptions\OutOfStockException;
use App\Http\Requests\CartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use Exception;

class CartItemService
{
    public function userCart(CartItemRequest $request)
    {
        $user = auth()->user();
        if (! $user) {
            throw new Exception('Register first');
        }

        $userCart = Cart::create(['user_id' => $user->id]);

        $cartItem = CartItem::create([
            'cart_id' => $userCart->id,
            'variant_id' => $request->variant_id,
            'quantity' => $request->quantity,
        ]);

        $cartItem->load('variant');

        if ($cartItem->quantity > $cartItem->variant->variant_stock) {
            throw new OutOfStockException;
        }

        return $cartItem;
    }
}
