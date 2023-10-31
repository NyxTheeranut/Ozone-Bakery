<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\MadeToOrder;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        $orderDetail = OrderDetail::get();
        $madeToOrderData = MadeToOrder::get();

        return view('layouts.orders.detail', [
            'orders' => $orders,
            'orderDetail' => $orderDetail,
            'madeToOrderData' => $madeToOrderData
        ]);
    }
}
