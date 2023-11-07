<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MadeToOrder;
use App\Models\Product;
use App\Models\Queue;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MadeToOrderController extends Controller
{
    public function index()
    {
        $products = Product::get();
        $discount = MadeToOrder::getDiscount();

        return response()->json([
            'products' => $products,
            'discount' => $discount,
        ]);
    }

    public function show(MadeToOrder $madeToOrder)
    {
        return $madeToOrder;
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        $madeToOrder = new MadeToOrder();

        $day=1;

        foreach (request('items') as $item) {
            $day += ceil($item['amount']/100);
        }

        $pickupDate = Queue::first()->queue($day);

        $madeToOrder->user_id = $request->get('user_id');
        $madeToOrder->pickup_date = $pickupDate;
        $madeToOrder->description = $request->get('description');
        $madeToOrder->save();

        foreach (request('items') as $item) {
            $item['made_to_order_id'] = $madeToOrder->id;
            Log::info($item);
            $response = app('request')->create(route('made-to-order-details.store'), 'POST', $item);
            app()->handle($response);
        }

        session(['made_to_order_id' => $madeToOrder->id]);

        return response()->json([
            'message' => 'Made to order created successfully',
            'data' => $madeToOrder
        ], 201);
    }

    public function update(Request $request, MadeToOrder $madeToOrder)
    {
        $request->validate([
            'status' => 'required|in:Pending Confirmation,In Progress,Ready for pickup,Complete,Rejected'
        ]);

        $madeToOrder->status = $request->get('status');
        $madeToOrder->save();

        return $madeToOrder;
    }

    public function destroy(MadeToOrder $madeToOrder)
    {
        $madeToOrder->delete();
        return ["message" => "Deleted successfully"];
    }
}
