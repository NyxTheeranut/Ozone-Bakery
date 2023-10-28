<?php

use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\IngredientController;
use App\Http\Controllers\View\MadeToOrderController;
use App\Http\Controllers\View\HistoryController;
use App\Http\Controllers\View\OrderDetailController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/mycart', [CartController::class, 'index'])->name('cart');

Route::get('/products/{id}', [ProductController::class, 'showProduct'])->name('layouts.products.detail');

Route::get('/custom-orders', [MadeToOrderController::class, 'index'])->name('layouts.products.made-to-order');

Route::get('/ingredients', [IngredientController::class, 'index'])->name('layouts.products.ingredient');

Route::get('/history', [HistoryController::class, 'index'])->name('layouts.orders.history');

Route::get('/history/{id}', [OrderDetailController::class, 'index'])->name('layouts.orders.detail');

Route::get('/orders', [OrderController::class, 'indexView'])->name('layouts.admin.order');