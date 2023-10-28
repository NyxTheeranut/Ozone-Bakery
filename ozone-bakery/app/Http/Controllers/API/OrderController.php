<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::get();
    }

    public function show(Order $order)
    {
        return $order;
    }

    public function store(Request $request)
    {
        $request->validate ([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer|min:0',
            'payment_status' => 'required|in:Pending,Completed,Failed',
        ]);

        $order = new Order();

        $order->user_id = $request->get('user_id');
        $order->amount = $request->get('amount');
        $order->payment_status = $request->get('payment_status');

        $order->save();
        $order->refresh();
        return $order;
    }

    public function update(Request $request, Order $order)
    {
        $request->validate ([
            'user_id' => 'nullable|exists:users,id',
            'amount' => 'nullable|integer|min:0',
            'payment_status' => 'nullable|in:Pending,Completed,Failed'
        ]);

        if ($request->has('user_id')) $order->user_id = $request->get('user_id');
        if ($request->has('amount')) $order->amount = $request->get('amount');
        if ($request->has('payment_status')) $order->payment_status = $request->get('payment_status');

        $order->save();
        $order->refresh();
        return $order;
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return ["message" => "delete successfully"];
    }
}
