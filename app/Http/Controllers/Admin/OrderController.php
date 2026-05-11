<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Services\Admin\OrderService;
use App\Http\Requests\Admin\OrderUpdateRequest;
use App\Http\Requests\Admin\OrderCreateRequest;
use App\Http\Resources\OrderResource;

class orderController extends ApiController
{
    public function __construct(protected OrderService $orderService){
    }
      public function index()
    {
        $orders = $this->orderService->getAllOrders();

        return $this->success(OrderResource::collection($orders), 'All orders');   
    }
    public function show( int $id)
    {
        $orderDetails = $this->orderService->getOrderDetails($id);

        return $this->success(new OrderResource($orderDetails), 'Order details');
    }

    public function update(OrderUpdateRequest $request, int $id)
    {
        $updateOrder = $this->orderService->updateOrder($id, $request->validated());

        return $this->success(new OrderResource($updateOrder), 'Order updated successfully');
    }
}
