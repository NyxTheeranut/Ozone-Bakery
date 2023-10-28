<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return $products;
        // $products = Product::get();

        // return view('layouts.products.index', [
        //     'products' => $products
        // ]);

    }

    public function show(Product $product)
    {
        return $product;
        
    }

    public function store(Request $request)
    {
        $request->validate ([
            'name' => 'required|string|min:3',
            'price' => 'required|integer|min:0'
        ]);

        $product = new Product();

        $product->name = $request->get('name');
        $product->price = $request->get('price');
        if ($request->has('image_path')) $product->image_path = $request->get('image_path');
        else $product->image_path = "Ozone-Bakery/public/image/product/default.jpg";
        if ($request->has('description')) $product->description = $request->get('description');
        else $product->description = "null";

        $product->save();
        $product->refresh();
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $request->validate ([
            'name' => 'nullable|string|min:3',
            'price' => 'nullable|integer|min:0',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->has('name')) $product->name = $request->get('name');
        if ($request->has('price')) $product->price = $request->get('price');
        if ($request->has('image_path')) $product->image_path = $request->get('image_path');
        $product->save();
        $product->refresh();
        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return ["message" => "delete successfully"];
    }
}
