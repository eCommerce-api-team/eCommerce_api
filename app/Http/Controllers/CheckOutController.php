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

        $amount = $request->input('amount');

        $checkout = $this->CheckoutService->checkout($productId, $amount);

        return $this->success('Order placed successfully');
        }

}