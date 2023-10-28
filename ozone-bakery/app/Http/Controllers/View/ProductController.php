<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function indexView()
    {
        $products = Product::get();

        return view('layouts.products.index', [
            'products' => $products
        ]);

    }
    
    public function showProduct($productId) {

        $product = Product::find($productId);
        return view('layouts.products.detail', compact('product'));
    }
}
