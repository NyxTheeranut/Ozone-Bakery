<?php

namespace App\Http\Controllers\View;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\QrCodeController;
use App\Models\Cart;
use App\Models\MadeToOrder;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function show()
    {
        // Get the cart items from the query parameters
        $user_id = auth()->user()->id;
        $carts = Cart::where('user_id', $user_id)->get();

        $cartItems = [];
        foreach ($carts as $cart) {
            $cartItems[] = [
                'product' => $cart->product,
                'quantity' => $cart->amount,
            ];
        }

        $pickupDate = Carbon::parse(session('pickupDate'))->format('Y/m/d');

        return view('layouts.checkout.index', [
            'cartItems' => $cartItems,
            'pickupDate' => $pickupDate,
        ]);
    }

    public function confirmOrder(Request $request)
    {
        $response = app('request')->create(route('cart.reset-on-confirm'), 'DELETE', $request->all());
        app()->handle($response);

        $response = app('request')->create(route('view.orders.post'), 'POST', $request->all());
        app()->handle($response);
        $order = session('order_id');

        return redirect()->route('view.orders.show', ['order' => $order]);
    }

    public function mtoCheckout(Request $request)
    {
        $discount = MadeToOrder::getDiscount();
        $pickup_date = $request->input('pickup_date');
        $description = $request->input('description');

        $items = json_decode($request->input('items'), true);

        $itemsCollection = new Collection();
        foreach ($items as $item) {
            $product = Product::find($item['product_id']);
            $amount = $item['amount'];
            if ($amount == 0) {
                continue;
            }
            $itemsCollection->push([
                'product' => $product,
                'amount' => $amount,
            ]);
        }

        return view('layouts.made-to-order.checkout', [
            'items' => $itemsCollection,
            'pickup_date' => $pickup_date,
            'description' => $description,
            'discount' => $discount,
        ]);
    }

    public function mtoConfirmOrder(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        $response = app('request')->create(route('made-to-orders.store'), 'POST', $request->all());
        app()->handle($response);

        return redirect()->route('made-to-order.show', ['madeToOrder' => session('made_to_order_id')]);
    }
}
