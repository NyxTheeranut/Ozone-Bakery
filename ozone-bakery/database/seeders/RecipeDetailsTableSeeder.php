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
            [
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 1, // Replace with valid ingredient_id
                'quantity' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'recipe_id' => 1, // Replace with valid recipe_id
                'ingredient_id' => 2, // Replace with valid ingredient_id
                'quantity' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        RecipeDetail::insert($data);
    }
}
