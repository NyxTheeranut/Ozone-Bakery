<?php

use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\IngredientController;
use App\Http\Controllers\API\MadeToOrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\View\CartController;
use App\Http\Controllers\View\CheckoutController;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/myprofile', [UserController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/products', [ProductController::class, 'indexView'])->name('layouts.products.index');


//Cart routes
Route::get('/mycart', [CartController::class, 'index'])->name('cart');
Route::post('/add-to-cart', [CartController::class, 'store'])->name('cart.add');
Route::put('/update-cart', [CartController::class, 'update'])->name('cart.update');

//Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');


Route::get('/products/{id}', [ProductController::class, 'showProduct'])->name('layouts.products.detail');

Route::get('/custom-orders', [MadeToOrderController::class, 'index'])->name('layouts.products.made-to-order');

Route::get('/ingredients', [IngredientController::class, 'index'])->name('layouts.products.ingredient');

Route::get('/customer-orders', [MadeToOrderController::class, 'index'])->name('layouts.products.made-to-order');