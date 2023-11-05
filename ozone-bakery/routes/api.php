<?php

use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\IngredientController;
use App\Http\Controllers\API\MadeToOrderController;
use App\Http\Controllers\API\MadeToOrderDetailController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\OrderDetailController;
use App\Http\Controllers\API\OrderStockDetailController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductStockController;
use App\Http\Controllers\API\RecipeController;
use App\Http\Controllers\API\RecipeDetailController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::put('/products/select-products', 'App\Http\Controllers\API\ProductController@selectProductsFromStock');

Route::apiResource('/users', UserController::class);
Route::get('/api/user', [UserController::class, 'getUserData']);


Route::apiResource('/orders', OrderController::class);

Route::apiResource('/products', ProductController::class);
Route::get('/api/products/{id}', 'API\ProductController@show');
Route::get('/products/available', 'App\Http\Controllers\API\ProductController@indexAvailableProduct');
Route::get('/products/all', 'App\Http\Controllers\API\ProductController@indexAllProduct');

Route::apiResource('/product-stocks', ProductStockController::class);

Route::apiResource('/order-details', OrderDetailController::class);

Route::apiResource('/recipes', RecipeController::class);

Route::apiResource('/ingredients', IngredientController::class);

Route::apiResource('/recipe-details', RecipeDetailController::class);

Route::apiResource('/made-to-orders', MadeToOrderController::class);

Route::apiResource('/made-to-order-details', MadeToOrderDetailController::class);

Route::apiResource('/carts', CartController::class);

Route::apiResource('/order-stock-details', OrderStockDetailController::class);
