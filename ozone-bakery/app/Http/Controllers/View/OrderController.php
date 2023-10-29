<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function indexView()
    {
        $orders = Order::get();
        
        return view('layouts.admin.order', [
            'products' => $orders
        ]);
    }

    
}
