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
            'name' => 'required|min:3|max:256',
            'yield' => 'required|integer',
            'duration' => 'required|date_format:H:i:s',
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
            'name' => 'nullable|min:3|max:256',
            'yield' => 'nullable|integer',
            'duration' => 'nullable|date_format:H:i:s',
        ]);

        if ($request->has('name')) $recipe->name = $request->get('name');
        if ($request->has('yield')) $recipe->yield = $request->get('yield');
        if ($request->has('duration')) $recipe->duration = $request->get('duration');

        $recipe->save();
        $recipe->refresh();
        return $recipe;
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return ["message" => "Deleted successfully"];
    }
}
