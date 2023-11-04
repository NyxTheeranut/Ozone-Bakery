<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function indexView(Request $request)
    {
        $pickUpDate = Carbon::now();
        if ($request->has('pickUpDate')) $pickUpDate = Carbon::parse($request->get('pickUpDate'))->format('Y-m-d');

        $availableProducts = Product::select('products.*', DB::raw('SUM(product_stocks.amount) as total_stock'))
            ->leftJoin('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->where('product_stocks.amount', '>', 0)
            ->where('product_stocks.exp_date', '>', $pickUpDate)
            ->groupBy('products.id', 'products.name')
            ->get();

        $allProducts = Product::select('products.*', DB::raw('COALESCE(SUM(product_stocks.amount), 0) as total_stock'))
            ->leftJoin('product_stocks', function ($join) use ($pickUpDate) {
                $join->on('products.id', '=', 'product_stocks.product_id')
                    ->where('product_stocks.amount', '>', 0)
                    ->where('product_stocks.exp_date', '>', $pickUpDate);
            })
            ->groupBy('products.id', 'products.name')
            ->get();


        Log::info($availableProducts);

        return view('layouts.products.index', [
            'availableProducts' => $availableProducts,
            'allProducts' => $allProducts,
            'pickUpDate' => $pickUpDate
        ]);
    }

    public function showProduct($productId)
    {

        $product = Product::find($productId);
        return view('layouts.products.detail', compact('product'));
    }

    public function store(Request $request)
    {
        Log::info($request->all());
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
        Log::info($product->id);
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

        Log::info("test");

        $product->save();
        $product->refresh();
        return $product;
    }
}
