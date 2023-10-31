<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class MadeToOrderController extends Controller
{
    public function index()
    {
        // $products = Product::get();
        // return $products;
        $products = Product::get();

        return view('layouts.products.made-to-order', [
            'products' => $products
        ]);
    }


}
