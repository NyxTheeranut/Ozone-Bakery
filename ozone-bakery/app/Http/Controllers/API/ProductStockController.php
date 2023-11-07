<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductStock;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    public function index()
    {
        return ProductStock::get();
    }

    public function show(ProductStock $productStock)
    {
        return $productStock;
    }

    public function store(Request $request)
    {
        $request->validate ([
            'product_id'    => 'required|exists:products,id',
            'amount'    => 'required|integer|min:0',
            'exp_date'  => 'required|date|after:yesterday'
        ]);
    
        $productStock = new ProductStock();
    
        $productStock->product_id = $request->get('product_id');
        $productStock->amount = $request->get('amount');
        $productStock->exp_date = $request->get('exp_date');
    
        $productStock->save();
        $productStock->refresh();
        return $productStock;
    }

    public function update(Request $request, ProductStock $productStock)
    {
        $request->validate ([
            'product_id'    => 'nullable|exists:products,id',
            'amount'    => 'nullable|integer|min:0',
            'exp_date'  => 'nullable|date'
        ]);
    
        if ($request->has('product_id')) $productStock->product_id = $request->get('product_id');
        if ($request->has('amount')) $productStock->amount = $request->get('amount');
        if ($request->has('exp_date')) $productStock->exp_date = $request->get('exp_date');
    
        $productStock->save();
        $productStock->refresh();
        return $productStock;
    }

    public function destroy(ProductStock $productStock)
    {
        $productStock->delete();
        return ["message" => "delete successfully"];
    }
}
