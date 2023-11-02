<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('layouts.admin.products', [
            'products' => $products
        ]);
    }

    public function showProduct(Product $product)
    {
        return view('layouts.admin.product', [
            'product' => $product
        ]);
    }

    public function showEditProductView($productId)
    {
        $product = Product::find($productId);

        return view('layouts.admin.edit-product', [
            'product' => $product
        ]);
    }

    public function showCreateProductView(Request $request)
    {
        Log::info('showCreateProductView');
        return view('layouts.admin.create-product');
    }
}
