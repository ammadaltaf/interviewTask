<?php
namespace App\Jobs;

use App\Models\Order;
use App\Models\Shipment;
use App\Services\ShippingService;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class CreateShipmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle(ShippingService $shippingService)
    {
        $result = $shippingService->createShipment($this->order);

        // Save shipment data
        $this->order->shipments()->create($result);
    }
}
