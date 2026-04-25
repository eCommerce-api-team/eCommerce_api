<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Exceptions\NotEnoughBalanceException;
use App\Exceptions\OutOfStockException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\CartItemRequest;
use App\Services\CheckoutService;

class CheckOutController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(protected CheckoutService $CheckoutService)
    {
        $this->CheckoutService = $CheckoutService;
    }

    public function store(CartItemRequest $request)
    {
        try {
            $checkout = $this->CheckoutService->checkout($request);

            event(new OrderPlaced($checkout));

            return $this->success('Order placed successfully');
        } catch (OutOfStockException $e) {

            return $this->error('Out Of Stock');
        } catch (NotEnoughBalanceException $e) {

            return $this->error('Insufficient balance');
        }
    }
}
