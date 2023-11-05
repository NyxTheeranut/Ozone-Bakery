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

    public function showProduct($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        if (session()->has('pickupDate')) {
            $pickupDate = Carbon::parse(session('pickupDate'))->format('Y-m-d');
        } else {
            session(['pickupDate' => Carbon::now()->format('Y-m-d')]);
            $pickupDate = Carbon::now()->format('Y-m-d');
        }

        return response()->json([
            'product' => $product,
            'pickupDate' => $pickupDate
        ]);
    }

    public function indexAvailableProduct()
    {
        $products = Product::select('products.*', DB::raw('SUM(product_stocks.amount) as total_stock'))
            ->leftJoin('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->where('product_stocks.amount', '>', 0)
            ->where('product_stocks.exp_date', '>=', now())
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
                    ->where('product_stocks.exp_date', '>=', now());
            })
            ->groupBy('products.id', 'products.name')
            ->get();

        return $products;
    }



    public function selectProductsFromStock(Request $request)
    {
        Log::info($request->all());
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|integer|min:1',
            'pickup_date' => 'required|date|after:yesterday',
        ]);
        Log::info("pass the validate");

        $stock = $this->getStock($request->input('product_id'));
        Log::info("stock: " . $stock);
        if ($stock < $request->input('amount')) {
            return response()->json([
                'message' => 'Not enough stock',
            ], 400);
        }

        $product = Product::find($request->input('product_id'));
        $amount = $request->input('amount');
        $pickupDate = Carbon::parse($request->input('pickup_date'))->format('Y-m-d');

        $product_stocks = $product->product_stocks;
        $product_stocks = $product_stocks->where('exp_date', '>=', $pickupDate);
        $product_stocks = $product_stocks->sortBy('exp_date');

        $data = [];

        foreach ($product_stocks as $stock) {
            if ($amount > 0) {
                $reduceAmount = min($stock->amount, $amount);
                $stock->amount -= $reduceAmount;
                $stock->save();
                $amount -= $reduceAmount;
                Log::info("Reduce stock amount: " . $stock->id . " by " . $reduceAmount);
                $data[] = [
                    'product_stock_id' => $stock->id,
                    'amount' => $reduceAmount,
                ];
            } else {
                break; // No need to reduce further
            }
        }
        return response()->json([
            'message' => 'Successfully reduce stock',
            'data' => $data,
        ], 200);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function getStock($product_id)
    {
        $pickupDate = Carbon::now()->format('Y-m-d');
        $totalStock = ProductStock::where('product_id', $product_id)
            ->where('amount', '>', 0)
            ->where('exp_date', '>=', $pickupDate)
            ->sum('amount');
        return $totalStock;
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
