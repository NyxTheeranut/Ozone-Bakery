<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::get();

        return view('layouts.products.ingredient', [
            'ingredients' => $ingredients,
        ]);
    }
}
