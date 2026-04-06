<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiController;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

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
        $productId = $request->input('product_id');
        
        $checkout = $this->CheckoutService->checkout($productId);

        return $this->success('Order placed successfully');
        }

}