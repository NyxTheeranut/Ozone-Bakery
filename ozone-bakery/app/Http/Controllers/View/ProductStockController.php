<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    public function index()
    {
        $productStocks = ProductStock::get();
        $products = Product::get();
        return view('layouts.admin.product-stocks', [
            'productStocks' => $productStocks,
            'products' => $products
        ]);
    }
}
