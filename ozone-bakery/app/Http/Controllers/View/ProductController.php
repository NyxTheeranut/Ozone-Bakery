<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductStock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function setPickupDate(Request $request)
    {
        $request->validate([
            'pickupDate' => 'required|date'
        ]);

        $pickupDate = Carbon::parse($request->get('pickupDate'))->format('Y-m-d');
        session(['pickupDate' => $pickupDate]);

        return redirect()->route('products.index');
    }

    public function indexView()
    {
        if (session()->has('pickupDate')) {
            $pickupDate = Carbon::parse(session('pickupDate'))->format('Y-m-d');
        } else {
            session(['pickupDate' => Carbon::now()->format('Y-m-d')]);
            $pickupDate = Carbon::now()->format('Y-m-d');
        }

        $availableProducts = Product::select('products.*', DB::raw('SUM(product_stocks.amount) as total_stock'))
            ->leftJoin('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->where('product_stocks.amount', '>', 0)
            ->where('product_stocks.exp_date', '>=', $pickupDate)
            ->groupBy('products.id', 'products.name')
            ->get();

        $allProducts = Product::select('products.*', DB::raw('COALESCE(SUM(product_stocks.amount), 0) as total_stock'))
            ->leftJoin('product_stocks', function ($join) use ($pickupDate) {
                $join->on('products.id', '=', 'product_stocks.product_id')
                    ->where('product_stocks.amount', '>', 0)
                    ->where('product_stocks.exp_date', '>=', $pickupDate);
            })
            ->groupBy('products.id', 'products.name')
            ->get();


        return view('layouts.products.index', [
            'availableProducts' => $availableProducts,
            'allProducts' => $allProducts,
            'pickupDate' => $pickupDate
        ]);
    }

    public function showProductDetail($id)
    {
        if (Auth::user()==null) {
            return redirect()->route('login');
        }
        // Fetch the product details by ID
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }
        $pickupDate = session()->has('pickupDate') ? Carbon::parse(session('pickupDate'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');


        return view('layouts.products.detail', compact('product', 'pickupDate'));
    }

    public function getStock($product)
    {
        Log::info(session('pickupDate'));
        $pickupDate = Carbon::parse(session('pickupDate'))->format('Y-m-d');
        Log::info('Pickup date: ' . $pickupDate);
        $totalStock = ProductStock::where('product_id', $product)
            ->where('amount', '>', 0)
            ->where('exp_date', '>=', $pickupDate)
            ->sum('amount');
        Log::info('Total stock: ' . $totalStock);
        return $totalStock;
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
