<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Services\CheckoutService;
use App\Http\Requests\CartItemRequest;
use App\Exceptions\OutOfStockException;
use App\Exceptions\NotEnoughBalanceException;

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
        try
        {
            
            $checkout = $this->CheckoutService->checkout($request);
            
            return $this->success('Order placed successfully');
        }
        catch(OutOfStockException $e){

            return $this->error('Out Of Stock');
        }
        catch(NotEnoughBalanceException $e){
            
            return $this->error('Insufficient balance');
        }
        }

}