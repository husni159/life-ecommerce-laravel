<?php
namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\OrderItem;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function createItem(array $itemData): OrderItem
    {
        return OrderItem::create($itemData);
    }
    public function find($id)
    {
        return Order::with('items.product')->findOrFail($id);
    }

    public function getUserOrders($userId)
    {
        return Order::with('items.product')
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}
