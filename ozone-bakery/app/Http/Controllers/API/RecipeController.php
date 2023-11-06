<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        return Recipe::get();
    }

    public function show(Recipe $recipe)
    {
        return $recipe;
    }

    public function store(Request $request)
    {
        $request->validate([
            'yield' => 'required|integer',
        ]);

        $recipe = new Recipe();

        $recipe->name = $request->get('name');
        $recipe->yield = $request->get('yield');
        $recipe->duration = $request->get('duration');

        $recipe->save();
        $recipe->refresh();
        return $recipe;
    }

    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'yield' => 'required|integer',
        ]);

        $recipe->yield = $request->get('yield');

        $recipe->save();
        return $recipe;
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return ["message" => "Deleted successfully"];
    }
}
