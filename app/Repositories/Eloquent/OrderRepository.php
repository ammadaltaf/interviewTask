<?php
namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface {

    public function find(int $id): ?Order{
        return Order::with(['items.product','staff'])->find($id);
    }

    public function create(array $data): Order{
        return Order::create($data);
    }

    public function update(Order $order, array $data): Order{
        $order->update($data);
        return $order;
    }
}