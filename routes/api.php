<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WebhookController;

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('products', ProductController::class);
    Route::post('orders', [OrderController::class,'store']);
    Route::post('orders/{order}/confirm', [OrderController::class,'confirm']);
});

Route::post('webhooks/shipping',[WebhookController::class,'handle']);