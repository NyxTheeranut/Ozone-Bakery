<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\MadeToOrder;
use App\Models\MadeToOrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class MadeToOrderController extends Controller
{
    
    public static $yield = 100;

    public function index()
    {
        // $items = Product::get();
        // return $items;
        $products = Product::get();

        return view('layouts.made-to-order.index', [
            'products' => $products,
            'discount' => MadeToOrder::getDiscount(),
        ]);
    }

    public function show(MadeToOrder $madeToOrder)
    {
        return view('layouts.made-to-order.show', [
            'madeToOrder' => $madeToOrder,
            'discount' => MadeToOrder::getDiscount(),
        ]);
    }

    public function store(Request $request)
    {
        $madeToOrder = new MadeToOrder();
        $madeToOrder->user_id = auth()->user()->id;
        $madeToOrder->pickup_date = $request->get('pickup_date');
        $madeToOrder->description = $request->get('description');
        $madeToOrder->save();
        $madeToOrder->refresh();

        foreach (request('items') as $item) { // Use 'items' to access the order details.
            $madeToOrderDetail = new MadeToOrderDetail();
            $madeToOrderDetail->made_to_order_id = $madeToOrder->id;
            $madeToOrderDetail->product_id = $item['product_id'];
            $madeToOrderDetail->amount = $item['amount'];
            $madeToOrderDetail->save();
            $madeToOrderDetail->refresh();
        }

        session()->put('made_to_order_id', $madeToOrder->id);

        return;
    }

    public function itemshow($id)
    {
        $product = Product::find($id);

        return view('layouts.made-to-order.product-show', [
            'product' => $product,
            'discount' => MadeToOrder::getDiscount(),
        ]);
    }

    public function continue(Request $request)
    {
        $items = new Collection();
        foreach (request('items') as $item) {
            $product = Product::find($item['product_id']);
            $amount = $item['amount'];
            if ($amount == 0) {
                continue;
            }

            $items->push([
                'product' => $product,
                'amount' => $amount,
            ]);

            Log::info($product . ' ' . $amount);
        }

        return view('layouts.made-to-order.continue', [
            'discount' => MadeToOrder::getDiscount(),
            'items' => $items,
        ]);
    }

    public function estimateDate(Request $request)
    {
        Log::info("test");
        $date = 0;
        $items = new Collection();
        foreach (request('items') as $item) {
            $product = Product::find($item['product_id']);
            $amount = $item['amount'];
            if ($amount == 0) {
                continue;
            }

            $items->push([
                'product' => $product,
                'amount' => $amount,
            ]);

            $date += ceil($amount/100);
        }
        $date += 2;

        $estimatedDate = Date::now()->addDays($date);

        return response()->json(['estimatedDate' => $estimatedDate->toDateString()]);
    }
}
