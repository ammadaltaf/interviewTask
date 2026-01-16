<?php
// app/Http/Controllers/WebhookController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipment;

class WebhookController extends Controller {
    public function handle(Request $request){
        $token = $request->header('x-webhook-token');
        if($token !== env('SHIPPING_WEBHOOK_TOKEN')){
            return response()->json(['message'=>'Unauthorized'],403);
        }

        $shipment = Shipment::where('tracking_number',$request->tracking_number)->first();
        if(!$shipment) return response()->json(['message'=>'Shipment not found'],404);

        $shipment->status = $request->event === 'shipment.delivered' ? 'delivered' : 'failed';
        $shipment->save();

        return response()->json(['message'=>'OK']);
    }
}