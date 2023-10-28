<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function show(Order $order)
    {
        return view('layouts.orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = auth()->user()->id; // Fixed the syntax for accessing the user ID.
        $order->amount = request('amount');
        $order->save();
        $order->refresh();
    
        foreach (request('items') as $item) { // Use 'items' to access the order details.
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $item['product_id'];
            $order_detail->amount = $item['quantity'];
            $order_detail->save();
            $order_detail->refresh();
        }
    
        return redirect()->route('orders.show', $order->id);
    }
    
}
