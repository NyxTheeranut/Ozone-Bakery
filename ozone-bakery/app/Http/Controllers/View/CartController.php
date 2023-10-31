<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // if ($user !== null) {
        //     Log::info('User is not null: ' . $user->name);
        // }

        // Get the cart items of the authenticated user
        $carts = Cart::where('user_id', $user->id)->get();
    
        return view('layouts.cart.index', [
            'carts' => $carts
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)
            ->where('product_id', request('product_id'))
            ->first();

        if ($cart !== null) {
            $cart->amount += request('amount');
            $cart->save();
            $cart->refresh();
        }
        else {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->product_id = request('product_id');
            $cart->amount = request('amount');
            $cart->save();
            $cart->refresh();
        }

        return redirect()->route('cart');
    }

    public function update(Request $request)
    {
        $data = $request->input('cart_items');
        // Use $request to access request data
        foreach ($data as $cartItemId => $cartItemData) {
            $cart = Cart::find($cartItemId);
            $cart->amount = $cartItemData['amount'];
            $cart->save();
            $cart->refresh();
            if ($cart->amount == 0) {
                $cart->delete();
            }
        }
    
        return redirect()->route('cart');
    }
    
}
