<?php
// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\OrderService;
use App\Models\Order;

class OrderController extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(private OrderService $orderService){
        $this->middleware('auth:sanctum');
    }

    public function store(CreateOrderRequest $request){
        $order = $this->orderService->createOrder(
            $request->user()->id,
            $request->staff_id,
            $request->products
        );
        return response()->json($order,201);
    }

    public function confirm(Order $order){
        $this->authorize('updateStatus',$order);
        $this->orderService->confirmOrder($order);
        return response()->json($order);
    }
}
