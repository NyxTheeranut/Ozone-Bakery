<?php

use App\Http\Controllers\View\MadeToOrderController;
use App\Http\Controllers\View\HistoryController;
use App\Http\Controllers\View\OrderDetailController;
use App\Http\Controllers\View\OrderController;
use App\Http\Controllers\View\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\View\AdminController;
use App\Http\Controllers\View\CartController;
use App\Http\Controllers\View\CheckoutController;
use App\Http\Controllers\View\IngredientController;
use App\Http\Controllers\View\ProductController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Wtf laravel
Route::get('/admin/products/create', [AdminController::class, 'showCreateProductView'])->name('layouts.admin.product.create');
Route::post('/ingredients', [IngredientController::class, 'store'])->name('layouts.products.ingredient.post');

Route::get('/', [HomeController::class, 'index'])
    ->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/myprofile', [UserController::class, 'index'])->name('profile.index');
    Route::post('/myprofile', [UserController::class, 'update'])->name('profile.update');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/products', [ProductController::class, 'indexView'])->name('layouts.products.index');

//Admin routes
Route::get('/admin/products', [AdminController::class, 'index'])->name('layouts.admin.products');
Route::get('/admin/products/{product}/edit', [AdminController::class, 'showEditProductView'])->name('layouts.admin.products.edit');
Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
Route::get('/admin/products/{product}', [AdminController::class, 'showProduct'])->name('layouts.admin.product');

//Cart routes
Route::get('/mycart', [CartController::class, 'index'])->name('cart')->middleware('auth');
Route::post('/add-to-cart', [CartController::class, 'store'])->name('cart.add');
Route::put('/update-cart', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/reset-on-confirm', [CartController::class, 'resetOnConfirm'])->name('cart.reset-on-confirm');

//Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/confirm-order', [CheckoutController::class, 'confirmOrder'])->name('confirm-order');

Route::get('/mto-checkout', [CheckoutController::class, 'mtoIndex'])->name('mto-checkout');

//Order routes
Route::post('/orders', [OrderController::class, 'store'])->name('view.orders.post');
Route::get('/order/{order}', [OrderController::class, 'show'])->name('view.orders.show');
Route::get('/orders', [OrderController::class, 'indexView'])->name('layouts.admin.order');

//Made to order routes
Route::get('/custom-orders', [MadeToOrderController::class, 'index'])->name('layouts.products.made-to-order');
Route::post('/mto-post', [MadeToOrderController::class, 'store'])->name('made-to-order.post');
//Route::get('/mto-continue', [MadeToOrderController::class, 'continue'])->name('mto-continue');
Route::post('/mto/checkout', [CheckoutController::class, 'mtoConfirmOrder'])->name('mto-confirm-order');
Route::post('/mto/estimate-date', [MadeToOrderController::class, 'estimateDate'])->name('mto-estimate-date');
Route::get('/mto/{madeToOrder}', [MadeToOrderController::class, 'show'])->name('made-to-order.show');
//Route::get('/mto/products/{id}', [MadeToOrderController::class, 'productShow'])->name('made-to-order-product.show');

//Product routes
Route::get('/products/{id}', [ProductController::class, 'showProduct'])->name('layouts.products.detail');
Route::post('/products', [ProductController::class, 'store'])->name('products.post');

//Ingredient routes
Route::get('/ingredients', [IngredientController::class, 'index'])->name('layouts.products.ingredient');

Route::get('/history', [HistoryController::class, 'index'])->name('layouts.orders.history');

Route::get('/orders', [OrderController::class, 'indexView'])->name('layouts.admin.order');
