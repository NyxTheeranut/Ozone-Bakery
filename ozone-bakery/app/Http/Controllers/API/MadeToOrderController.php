<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MadeToOrder;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;

class MadeToOrderController extends Controller
{
    public function index()
    {
        return MadeToOrder::get();
    }

    public function show(MadeToOrder $madeToOrder)
    {
        return $madeToOrder;
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'recipe_id' => 'required|exists:recipes,id',
            'price' => 'required|integer',
            'order_status' => 'in:Evaluating,Negotiating,In Progress,Waiting,Complete,Rejected',
            'pickup_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $madeToOrder = new MadeToOrder();

        $madeToOrder->user_id = $request->get('user_id');
        $madeToOrder->recipe_id = $request->get('recipe_id');
        $madeToOrder->price = $request->get('price');
        $madeToOrder->order_status = $request->get('order_status');
        $madeToOrder->pickup_date = $request->get('pickup_date');
        $madeToOrder->description = $request->get('description');

        $madeToOrder->save();
        $madeToOrder->refresh();
        return $madeToOrder;
    }

    public function update(Request $request, MadeToOrder $madeToOrder)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'recipe_id' => 'nullable|exists:recipes,id',
            'price' => 'nullable|integer',
            'order_status' => 'nullable|in:Evaluating,Negotiating,In Progress,Waiting,Complete,Rejected',
            'pickup_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        if ($request->filled('user_id')) $madeToOrder->user_id = $request->get('user_id');
        if ($request->filled('recipe_id')) $madeToOrder->recipe_id = $request->get('recipe_id');
        if ($request->filled('price')) $madeToOrder->price = $request->get('price');
        if ($request->filled('order_status')) $madeToOrder->order_status = $request->get('order_status');
        if ($request->filled('pickup_date')) $madeToOrder->pickup_date = $request->get('pickup_date');
        if ($request->filled('description')) $madeToOrder->description = $request->get('description');

        $madeToOrder->save();
        $madeToOrder->refresh();
        return $madeToOrder;
    }

    public function destroy(MadeToOrder $madeToOrder)
    {
        $madeToOrder->delete();
        return ["message" => "Deleted successfully"];
    }
}
