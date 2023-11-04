<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MadeToOrderDetail;

class MadeToOrderDetailController extends Controller
{

    public function index()
    {
        return MadeToOrderDetail::get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'made_to_order_id' => 'required|exists:made_to_orders,id',
            'product_id' => 'required|integer',
            'amount' => 'required|integer'
        ]);

        $madeToOrderDetail = new MadeToOrderDetail();
        $madeToOrderDetail->made_to_order_id = $request->get('made_to_order_id');
        $madeToOrderDetail->product_id = $request->get('product_id');
        $madeToOrderDetail->amount = $request->get('amount');

        $madeToOrderDetail->save();

        return response()->json([
            'message' => 'Made to order detail created successfully',
            'data' => $madeToOrderDetail
        ], 201);
    }
}
