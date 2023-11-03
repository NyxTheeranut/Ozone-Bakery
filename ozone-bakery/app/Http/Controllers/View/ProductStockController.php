<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    public function index()
    {
        return view('layouts.admin.product-stocks');
    }
}
