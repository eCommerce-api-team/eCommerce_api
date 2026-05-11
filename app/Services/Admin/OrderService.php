<?php

namespace App\Services\Admin;

use App\Models\Order;

class OrderService
{
    public function getAllOrders($request = null, int $perPage = 10){
       return $orders = Order::Filter($request)->paginate($perPage);
    }
    public function getOrder(int $id){
       return $order = Order::findOrFail($id);
    }
    public function refundOrder(int $id, array $data){
        $order = Order::findOrFail($id);   
        $order->update([
            'payment_status' => 'refunded'
        ]);
        return $order;
    }
}
