<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductStock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        return Product::get();
    }

    public function indexAvailableProduct()
    {
        $products = Product::select('products.*', DB::raw('SUM(product_stocks.amount) as total_stock'))
            ->leftJoin('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->where('product_stocks.amount', '>', 0)
            ->where('product_stocks.exp_date', '>', now()->addDays(3))
            ->groupBy('products.id', 'products.name')
            ->get();

        return $products;
    }

    public function indexAllProduct()
    {
        $products = Product::select('products.*', DB::raw('COALESCE(SUM(product_stocks.amount), 0) as total_stock'))
            ->leftJoin('product_stocks', function ($join) {
                $join->on('products.id', '=', 'product_stocks.product_id')
                    ->where('product_stocks.amount', '>', 0)
                    ->where('product_stocks.exp_date', '>', now()->addDays(3));
            })
            ->groupBy('products.id', 'products.name')
            ->get();

        return $products;
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'price' => 'required|integer|min:0',
            'image' => 'required|string',
            'description' => 'required|string',
        ]);

        $product = new Product();

        $product->name = $request->get('name');
        $product->price = $request->get('price');
        $product->description = $request->get('description');
        $product->save();

        //Save the image
        $base64Image = $request->get('image');
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
        $imageName = $product->id . '.' . 'jpg';
        // Save the image using the Storage facade
        Storage::put('public/image/product/' . $imageName, $imageData);
        // Update the image path in the database
        $product->image_path = '/storage/image/product/' . $imageName;

        $product->save();

        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'nullable|string|min:3',
            'price' => 'nullable|integer|min:0',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
        ]);


        if ($request->has('name')) {
            $product->name = $request->get('name');
        }

        if ($request->has('price')) {
            $product->price = $request->get('price');
        }

        if ($request->has('description')) {
            $product->description = $request->get('description');
        }

        if ($request->has('image')) {
            $base64Image = $request->get('image');
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
            $imageName = $product->id . '.' . 'jpg';

            // Save the image using the Storage facade
            Storage::put('public/image/product/' . $imageName, $imageData);

            // Update the image path in the database
            $product->image_path = '/storage/image/product/' . $imageName;
        }

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
