<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RecipeController extends Controller
{
    public function show(Product $product)
    {
        Log::debug($product);
        $recipe = $product->recipe;
        Log::debug($recipe);
        $ingredients = Ingredient::get();
        Log::debug($ingredients);
        if ($recipe == null) {
            $recipe = new Recipe();
            $recipe->product_id = $product->id;
            $recipe->save();
        }
        return view('layouts.admin.recipe', [
            'product' => $product,
            'recipe' => $recipe,
            'ingredients' => $ingredients,
        ]);
    }
}
