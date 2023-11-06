<?php

namespace Database\Seeders;

use App\Models\RecipeDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [//banancake
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 1, // Replace with valid ingredient_id
                'quantity' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 39, // Replace with valid ingredient_id
                'quantity' => 1/2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 30, // Replace with valid ingredient_id
                'quantity' => 3/4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 20, // Replace with valid ingredient_id
                'quantity' => 155,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 8, // Replace with valid ingredient_id
                'quantity' => 1/2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 26, // Replace with valid ingredient_id
                'quantity' => 165,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 2, // Replace with valid ingredient_id
                'quantity' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 17, // Replace with valid ingredient_id
                'quantity' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 47, // Replace with valid ingredient_id
                'quantity' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 3, // Replace with valid ingredient_id
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 9, // Replace with valid ingredient_id
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        RecipeDetail::insert($data);
    }
}
