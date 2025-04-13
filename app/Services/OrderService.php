<?php
namespace App\Services;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Product;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->create([
                'user_id' => $data['user_id'],
                'total_price' => $data['total_price'],
            ]);

            foreach ($data['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->stock_quantity < $item['quantity']) {
                    throw new Exception("Insufficient stock for product: {$product->name}");
                }

                $this->orderRepository->createItem([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                $product->decrement('stock_quantity', $item['quantity']);
            }

            DB::commit();
            return $order;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getById($id)
    {
        return $this->orderRepository->find($id);
    }

    public function getUserOrders($userId)
    {
        return $this->orderRepository->getUserOrders($userId);
    }
}
