<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\MadeToOrder;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

    public function show(Order $order) //GET order.show ex: redirect()->route('orders.show', ['orderId' => $orderId]);
    {
        return view('layouts.orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->save();
    
        foreach (request('items') as $item) { // Use 'items' to access the order details.
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $item['product_id'];
            $order_detail->amount = $item['quantity'];
            $order_detail->save();
            $order_detail->refresh();
        }

        session()->put('order_id', $order->id);

        return;
    }

    public function indexView() {
        $orders = Order::get();
        $madeToOrderData = MadeToOrder::get();

        return view('layouts.admin.order', [
            'orders' => $orders,
            'madeToOrderData' => $madeToOrderData
        ]);
    }
    
}
