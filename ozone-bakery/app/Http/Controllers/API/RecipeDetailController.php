<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RecipeDetail;
use Illuminate\Http\Request;

class RecipeDetailController extends Controller
{
    public function index()
    {
        return RecipeDetail::get();
    }

    public function show(RecipeDetail $recipeDetail)
    {
        return $recipeDetail;
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric',
        ]);
        

        if (RecipeDetail::where('recipe_id', $request->get('recipe_id'))
            ->where('ingredient_id', $request->get('ingredient_id'))->exists()) 
        {
            return response([
                'error' => 'Recipe detail already exists'
            ], 400);
        }

        $recipeDetail = new RecipeDetail();

        $recipeDetail->recipe_id = $request->get('recipe_id');
        $recipeDetail->ingredient_id = $request->get('ingredient_id');
        $recipeDetail->quantity = $request->get('quantity');

        $recipeDetail->save();
        $recipeDetail->refresh();
        return $recipeDetail;
    }

    public function update(Request $request, RecipeDetail $recipeDetail)
    {
        $request->validate([
            'recipe_id' => 'nullable|exists:recipes,id',
            'ingredient_id' => 'nullable|exists:ingredients,id',
            'quantity' => 'nullable|numeric',
        ]);

        if ($request->get('quantity')==0) {
            $recipeDetail->delete();
            return ["message" => "Deleted successfully"];
        }

        if ($request->has('recipe_id')) $recipeDetail->recipe_id = $request->get('recipe_id');
        if ($request->has('ingredient_id')) $recipeDetail->ingredient_id = $request->get('ingredient_id');
        if ($request->has('quantity')) $recipeDetail->quantity = $request->get('quantity');

        $recipeDetail->save();
        $recipeDetail->refresh();
        return $recipeDetail;
    }

    public function destroy(RecipeDetail $recipeDetail)
    {
        $recipeDetail->delete();
        return ["message" => "Deleted successfully"];
    }
}
