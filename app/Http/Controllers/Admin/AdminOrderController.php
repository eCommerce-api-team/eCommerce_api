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

    public function show(int $id)
    {
        $order = $this->orderService->getOrderDetails($id);

        $this->authorize('view', $order);

        return $this->success(new OrderResource($order), 'Order details');
    }

    public function update(OrderUpdateRequest $request, int $id)
    {
        $order = $this->orderService->updateOrder($id, $request->validated());

        $this->authorize('update', $order);

        return $this->success(new OrderResource($order), 'Order updated successfully');
    }
}
