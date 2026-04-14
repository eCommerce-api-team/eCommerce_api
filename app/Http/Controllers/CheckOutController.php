<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        try
        {
            $productId = $request->input('product_id');
            
            $amount = $request->input('amount');
            
            $checkout = $this->CheckoutService->checkout($productId, $amount);
            
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