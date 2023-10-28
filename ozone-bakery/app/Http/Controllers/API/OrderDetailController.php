<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        return OrderDetail::get();
    }

    public function show(OrderDetail $orderDetail)
    {
        return $orderDetail;
    }

    public function store(Request $request)
    {
        $request->validate ([
            'order_id' => 'required|exists:order,id',
            'product_id' => 'required|exists:product,id',
            'amount' => 'required|integer|min:0'
        ]);

        $orderDetail = new OrderDetail();

        $orderDetail->order_id = $request->get('order_id');
        $orderDetail->product_id = $request->get('product_id');
        $orderDetail->amount = $request->get('amount');

        $orderDetail->save();
        $orderDetail->refresh();
        return $orderDetail;
    }

    public function update(Request $request, OrderDetail $orderDetail)
    {
        $request->validate ([
            'order_id' => 'nullable|exists:order,id',
            'product_id' => 'nullable|exists:product,id',
            'amount' => 'nullable|integer|min:0',
        ]);

        if ($request->has('order_id')) $orderDetail->order_id = $request->get('order_id');
        if ($request->has('product_id')) $orderDetail->product_id = $request->get('product_id');
        if ($request->has('amount')) $orderDetail->amount = $request->get('amount');

        $orderDetail->save();
        $orderDetail->refresh();
        return $orderDetail;
    }

    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();
        return ["message" => "delete successfully"];
    }
}
