<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('welcome', [
            'products' => $products
        ]);

    }
}
