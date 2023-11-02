<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::get();

        return view('layouts.admin.ingredients', [
            'ingredients' => $ingredients,
        ]);
    }

    public function store(Request $request)
    {
        $ingredient = new Ingredient();
        $ingredient->name = request('name');
        $ingredient->quantity_unit = request('quantity_unit');
        $ingredient->save();

        return $ingredient;
    }
}
