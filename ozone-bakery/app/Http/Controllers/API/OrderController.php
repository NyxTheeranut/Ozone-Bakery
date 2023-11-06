<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStockDetail;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        return Order::get();
    }

    public function indexView()
    {
        $orders = Order::get();

        return view('layouts.admin.order', [
            'products' => $orders
        ]);
    }

    public function show(Order $order)
    {
        return $order;
    }

    public function store(Request $request)
    {
        Log::info($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'pickup_date' => 'required|date|after:yesterday',
            'order_details' => 'required|array',
            'order_details.*.product_id' => 'required|integer|exists:products,id',
            'order_details.*.amount' => 'required|integer|min:1',
        ]);
        Log::info("pass the validate");

        $order = [];
        $unsaveStocks = [];
        $orderDetails = [];
        $orderStockDetails = [];

        $order = new Order();
        $order->user_id = $request->get('user_id');

        $pickupDate = $request->get('pickup_date');
        $details = $request->get('order_details');

        foreach ($details as $detail) {
            $product = Product::find($detail['product_id']);
            $amount = $detail['amount'];
            if ($product->getStock($pickupDate) < $detail['amount']) {
                return response()->json([
                    'message' => 'Not enough stock for ' . $product->name
                ], 400);
            }

            $productStocks = ProductStock::where('product_id', $product->id)
                ->where('exp_date', '>=', $pickupDate)
                ->orderBy('exp_date')
                ->get();

            foreach ($productStocks as $stock) {
                $reduceAmount = min($stock->amount, $amount);
                $stock->amount -= $reduceAmount;
                $amount -= $reduceAmount;
                $unsaveStocks[] = $stock; //To be save later
                $orderStockDetail = new OrderStockDetail();
                $orderStockDetail->product_stock_id = $stock->id;
                $orderStockDetail->amount = $reduceAmount;
                $orderStockDetails[] = $orderStockDetail; //To be save later

                Log::info("Reduce stock amount: " . $stock->id . " by " . $reduceAmount);

                if ($amount == 0) break;
            }

            $orderDetail = new OrderDetail();
            $orderDetail->product_id = $product->id;
            $orderDetail->amount = $detail['amount'];
            $orderDetails[] = $orderDetail; //To be save later
        }

        $order->save();
        Log::info("Save order: " . $order->id);

        foreach ($orderStockDetails as $orderStockDetail) {
            Log::info($orderStockDetail);
            $orderStockDetail->order_id = $order->id;
            $orderStockDetail->save();
            Log::info("Save order stock detail: " . $orderStockDetail->id);
        }
        foreach ($orderDetails as $orderDetail) {
            Log::info($orderDetail);
            $orderDetail->order_id = $order->id;
            $orderDetail->save();
            Log::info("Save order detail: " . $orderDetail->id);
        }
        foreach ($unsaveStocks as $stock) {
            $stock->save();
            Log::info("Save stock: " . $stock->id);
        }

        return response()->json([
            'message' => 'Order created successfully',
            'order_id' => $order->id
        ], 201);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Pending,Waiting,Completed,Failed'
        ]);

        $order->status = $request->get('status');
        $order->save();
        
        return $order;
    }

    public function rejectOrder(Order $order)
    {
        $order_stock_details = OrderStockDetail::where('order_id', $order->id)->get();
        foreach ($order_stock_details as $order_stock_detail) {
            $product_stock = ProductStock::find($order_stock_detail->product_stock_id);
            $product_stock->amount += $order_stock_detail->amount;
            $product_stock->save();
        }

        $order->status = 'Failed';
        $order->save();

        return $order;
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return ["message" => "delete successfully"];
    }
}
