<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OrderStockDetail;
use Illuminate\Http\Request;

class OrderStockDetailController extends Controller
{
    //
    public function index(){
        $orderStockDetail = OrderStockDetail::get();
        return $orderStockDetail;
    }

    public function show(OrderStockDetail $orderStockDetail){
        return $orderStockDetail;
    }

    public function store(Request $request){
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_stock_id' => 'required|exists:product_stocks,id',
            'amount' => 'required|integer|min:1',
        ]);

        $orderStockDetail = new OrderStockDetail();
        $orderStockDetail->order_id = $request->order_id;
        $orderStockDetail->stock_id = $request->stock_id;
        $orderStockDetail->quantity = $request->quantity;
        $orderStockDetail->save();

        return $orderStockDetail;
    }
}
