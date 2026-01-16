<?php
namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;

class ShippingService {

    public function createShipment(Order $order): array {
        try {
            $response = Http::timeout(10)->post(env('SHIPPING_API_URL'), [
                'order_id' => $order->id,
                'customer_name' => $order->user->name,
                'shipping_address' => $order->user->address ?? 'default address',
                'total_weight' => $this->calculateWeight($order),
                'total_amount' => $order->total
            ]);

            if (!$response->successful()) {
                return [
                    'status' => 'failed',
                    'provider_response' => $response->body()
                ];
            }

            $data = $response->json();

            return [
                'shipment_id' => $data['shipment_id'] ?? null,
                'tracking_number' => $data['tracking_number'] ?? null,
                'label_url' => $data['label_url'] ?? null,
                'provider_response' => $response->body(),
                'status' => 'created'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'failed',
                'provider_response' => $e->getMessage()
            ];
        }
    }

    private function calculateWeight(Order $order): float {
        // Assume 1kg per product per quantity
        return $order->items->sum(fn($item) => $item->quantity * 1);
    }
}