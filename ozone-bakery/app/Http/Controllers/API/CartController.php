<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        return Cart::get(); 
    }

    public function show(Cart $cart)
    {
        return $cart;
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|integer|min:0',
        ]);

        $cart = new Cart();

        $cart->user_id = $request->get('user_id');
        $cart->product_id = $request->get('product_id');
        $cart->amount = $request->get('amount');

        $cart->save();
        $cart->refresh();
        return $cart;
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'amount' => 'nullable|integer|min:0',
        ]);

        if ($request->has('amount')) $cart->amount = $request->get('amount');
        $cart->save();
        if ($cart->amount == 0) $cart->delete();
        return $cart;
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return ["message" => "Deleted successfully"];
    }
}
