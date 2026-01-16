<?php
// app/Services/OrderService.php
namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Jobs\CreateShipmentJob;

class OrderService {

    public function createOrder(int $userId, int $staffId, array $products): Order {
        return DB::transaction(function() use ($userId,$staffId,$products){
            $subtotal = 0;
            $order = Order::create([
                'user_id'=>$userId,
                'assigned_staff_id'=>$staffId,
                'status'=>'pending',
                'subtotal'=>0,
                'tax'=>0,
                'total'=>0
            ]);

            foreach($products as $p){
                $product = Product::lockForUpdate()->findOrFail($p['id']);
                if($product->stock_quantity < $p['quantity']){
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                $product->stock_quantity -= $p['quantity'];
                $product->save();

                $subtotal += $product->price * $p['quantity'];

                OrderItem::create([
                    'order_id'=>$order->id,
                    'product_id'=>$product->id,
                    'quantity'=>$p['quantity'],
                    'price'=>$product->price
                ]);
            }

            $tax = $subtotal * 0.1;
            $total = $subtotal + $tax;

            $order->update(['subtotal'=>$subtotal,'tax'=>$tax,'total'=>$total]);
            return $order;
        });
    }

    public function confirmOrder(Order $order){
        $order->status = 'confirmed';
        $order->save();

        // Dispatch shipment job
        dispatch(new CreateShipmentJob($order));
    }

    public function cancelOrder(Order $order){
        DB::transaction(function() use($order){
            if($order->status === 'cancelled'){
                throw new \Exception('Order already cancelled');
            }
            $order->status = 'cancelled';
            $order->save();

            foreach($order->items as $item){
                $product = $item->product;
                $product->stock_quantity += $item->quantity;
                $product->save();
            }
        });
    }
}
