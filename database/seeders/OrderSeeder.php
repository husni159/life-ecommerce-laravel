<?php
namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::where('role', 'customer')->get();
        $products = Product::all();

        foreach ($customers as $customer) {
            foreach (range(1, rand(1, 3)) as $orderIndex) {
                $order = Order::create([
                    'user_id' => $customer->id,
                    'total_price' => 0, // will be updated after items added
                ]);

                $total = 0;

                foreach (range(1, rand(1, 4)) as $i) {
                    $product = $products->random();
                    $quantity = rand(1, 5);
                    $price = $product->price;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);

                    $total += $price * $quantity;
                }

                $order->update(['total_price' => $total]);
            }
        }
    }
}

