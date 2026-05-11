<?php

namespace App\Interfaces;

interface PaymentGatewayInterface
{
    public function checkoutPayment($order);
}
