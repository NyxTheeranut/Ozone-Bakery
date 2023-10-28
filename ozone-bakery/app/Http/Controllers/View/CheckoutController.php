<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Get the cart items from the query parameters
        $cartItems = $request->input('cart_items');

        // Process the cart items as needed
        // For example, you can loop through $cartItems and perform actions

        return view('layouts.checkout.index', compact('cartItems'));
    }
}
