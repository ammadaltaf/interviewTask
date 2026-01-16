<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Shipment;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_shipping' => Shipment::count(),
        ];

        return view('dashboard.index', compact('data'));
    }
}