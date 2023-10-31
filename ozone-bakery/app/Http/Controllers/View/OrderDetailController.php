<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\MadeToOrder;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index($orderId)
    {
        // Fetch the specific order using the provided $orderId
        $order = Order::find($orderId);

        // Check if the order exists
        if (!$order) {
            abort(404); // You can handle this case as needed
        }

        return view('layouts.orders.detail', [
            'order' => $order,
        ]);
    }
}
