<?php

namespace App\Services\Gateways;

use App\Interfaces\PaymentGatewayInterface;
use App\Models\Cart;
use Stripe\Checkout\Session;

class StripeService implements PaymentGatewayInterface
{
    public function checkoutPayment($order)
    {
        $cart = Cart::with('cartItems')
            ->where('user_id', auth()->user()->id)
            ->first();

        $lineItems = [];

        foreach ($cart->cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'egp',
                    'product_data' => [
                        'name' => $item->variant->name,
                    ],
                    'unit_amount' => $item->variant->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        return Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
            'metadata' => [
                'order_id' => $order->id,
            ],
        ]);

    }
}
