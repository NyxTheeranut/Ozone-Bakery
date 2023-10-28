<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\MadeToOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        $madeToOrderData = MadeToOrder::get();

        return view('layouts.orders.history', [
            'orders' => $orders,
            'madeToOrderData' => $madeToOrderData
        ]);
    }
}
