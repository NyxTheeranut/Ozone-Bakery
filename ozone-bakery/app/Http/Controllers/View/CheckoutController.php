<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Get the cart items from the query parameters
        $cartItems = $request->input('cart_items');

        foreach ($cartItems as $cartItemId => $cartItemData) {
            $cartItems[$cartItemId]['product'] = Product::find($cartItemData['product']);
            $cartItems[$cartItemId]['quantity'] = (int) $cartItemData['quantity'];
        }

        // Process the cart items as needed
        // For example, you can loop through $cartItems and perform actions

        return view('layouts.checkout.index', compact('cartItems'));
    }
}
