<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Response;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    use HttpResponses;
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    // Create new order
    public function store(StoreOrderRequest $request)
    {
        try{
            $validated = $request->validated();
            $totalPrice = collect($validated['items'])->sum(fn($item) => $item['price'] * $item['quantity']);
            $order = $this->orderService->create([
                'user_id' => Auth::id(),
                'items' => $validated['items'],
                'total_price' => $totalPrice,
            ]);

            return $this->success($order, 'Order created successfully', 201);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    // View order history
    public function index()
    {
        try{
            $orders = $this->orderService->getUserOrders(Auth::id());
            return $this->success($orders, 'Orders retrieved successfully', 201);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    // View single order
    public function show($id)
    {
        try{
            $order = $this->orderService->getById($id);

            if (!$order) {
                return $this->error(null,'Order not found or unauthorized', 404);
            }

            return $this->success($order, 'Order retrieved successfully', 201);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
