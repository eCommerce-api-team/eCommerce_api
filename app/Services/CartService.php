<?php

namespace App\Services;
use App\Models\Cart;
use App\Models\User;
use Exception;
class CartService
{
   
    public function userCart()
    {
        $user = auth()->user();
        if (!$user)
        {
            throw new Exception('Register first');
        }

        return $userCart = Cart::create(['user_id'=>$user->id]);
    }
}
