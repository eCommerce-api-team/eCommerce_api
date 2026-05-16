<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\OrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\Admin\OrderService;

class AdminOrderController extends ApiController
{
    public function __construct(protected OrderService $orderService) {}

    public function index()
    {
        $this->authorize('viewAny', Order::class);

        $orders = $this->orderService->getAllOrders();

        return $this->success(OrderResource::collection($orders), 'All orders');
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        $order = $this->orderService->getOrder($order->id);

        return $this->success(new OrderResource($order), 'Order details');
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        $this->authorize('update', $order);

        $order = $this->orderService->updateOrder($order->id, $request->validated());

        return $this->success(new OrderResource($order), 'Order updated successfully');
    }
}
