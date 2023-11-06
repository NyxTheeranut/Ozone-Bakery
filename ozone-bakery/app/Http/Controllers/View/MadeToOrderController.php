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
        return view('layouts.made-to-order.index', [
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

    public function itemshow($id)
    {
        $product = Product::find($id);

        return view('layouts.made-to-order.product-show', [
            'product' => $product,
            'discount' => MadeToOrder::getDiscount(),
        ]);
    }

    public function estimateDate(Request $request)
    {
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
