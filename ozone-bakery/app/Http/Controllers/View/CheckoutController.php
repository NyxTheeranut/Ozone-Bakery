<?php

namespace App\Http\Controllers\View;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\QrCodeController;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Get the cart items from the query parameters
        $totalPrice = 0;
        $cartItems = $request->input('cart_items');

        $products = collect();

        foreach ($cartItems as $cartItemId => $cartItemData) {
            $cartItems[$cartItemId]['product'] = Product::find($cartItemData['product']);
            $cartItems[$cartItemId]['quantity'] = (int) $cartItemData['quantity'];
            $totalPrice += $cartItems[$cartItemId]['product']->price * $cartItems[$cartItemId]['quantity'];
        }

        return view('layouts.checkout.index', compact('cartItems', 'totalPrice'));
    }
}
