<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        return response()->json($ingredients);
    }

    public function show(Ingredient $ingredient)
    {
        return $ingredient;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity_unit' => 'required|string|max:255',
        ]);

        $ingredient = new Ingredient();

        $ingredient->name = $request->get('name');
        $ingredient->quantity_unit = $request->get('quantity_unit');

        $ingredient->save();
        $ingredient->refresh();
        return $ingredient;
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'quantity_unit' => 'nullable|string|max:255',
        ]);

        if ($request->has('name')) $ingredient->name = $request->get('name');
        if ($request->has('quantity_unit')) $ingredient->quantity_unit = $request->get('quantity_unit');

        $ingredient->save();
        $ingredient->refresh();
        return $ingredient;
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return ["message" => "Deleted successfully"];
    }
}
