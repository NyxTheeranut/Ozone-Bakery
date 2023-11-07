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
                'recipe_id' => 1,
                'ingredient_id' => 33,
                'quantity' => 180,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 38,
                'quantity' => 0.5,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 28,
                'quantity' => 0.75,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 18,
                'quantity' => 155,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 7,
                'quantity' => 0.5,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 24,
                'quantity' => 165,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 8,
                'quantity' => 2,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 2,
                'quantity' => 200,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 15,
                'quantity' => 60,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 46,
                'quantity' => 40,
            ],
            [
                'recipe_id' => 1,
                'ingredient_id' => 3,
                'quantity' => 1,
            ],
        ];
        RecipeDetail::insert($data);

        $data = [
            [
                'recipe_id' => 2,
                'ingredient_id' => 27,
                'quantity' => 187,
            ],
            [
                'recipe_id' => 2,
                'ingredient_id' => 14,
                'quantity' => 50,
            ],
            [
                'recipe_id' => 2,
                'ingredient_id' => 12,
                'quantity' => 140,
            ],
            [
                'recipe_id' => 2,
                'ingredient_id' => 19,
                'quantity' => 235,
            ],
            [
                'recipe_id' => 2,
                'ingredient_id' => 8,
                'quantity' => 4,
            ],
            [
                'recipe_id' => 2,
                'ingredient_id' => 34,
                'quantity' => 155,
            ],
            [
                'recipe_id' => 2,
                'ingredient_id' => 35,
                'quantity' => 44,
            ],
            [
                'recipe_id' => 2,
                'ingredient_id' => 11,
                'quantity' => 45,
            ],
            [
                'recipe_id' => 2,
                'ingredient_id' => 7,
                'quantity' => 0.5,
            ],
        ];
        RecipeDetail::insert($data);

        $data = [
            [
                'recipe_id' => 3,
                'ingredient_id' => 32,
                'quantity' => 85,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 37,
                'quantity' => 0.5,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 18,
                'quantity' => 280,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 7,
                'quantity' => 0.25,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 16,
                'quantity' => 390,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 21,
                'quantity' => 340,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 8,
                'quantity' => 3,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 1,
                'quantity' => 10,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 27,
                'quantity' => 230,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 4,
                'quantity' => 1,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 35,
                'quantity' => 50,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 40,
                'quantity' => 1,
            ],
            [
                'recipe_id' => 3,
                'ingredient_id' => 31,
                'quantity' => 40,
            ],
        ];
        RecipeDetail::insert($data);

        $data = [
            [
                'recipe_id' => 4,
                'ingredient_id' => 32,
                'quantity' => 100,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 37,
                'quantity' => 1,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 8,
                'quantity' => 3,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 18,
                'quantity' => 130,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 7,
                'quantity' => 0.25 + 0.125,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 20,
                'quantity' => 40,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 16,
                'quantity' => 40,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 1,
                'quantity' => 15,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 27,
                'quantity' => 120,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 4,
                'quantity' => 1.5,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 48,
                'quantity' => 1,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 42,
                'quantity' => 150,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 31,
                'quantity' => 25,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 6,
                'quantity' => 150,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 23,
                'quantity' => 50,
            ],
            [
                'recipe_id' => 4,
                'ingredient_id' => 47,
                'quantity' => 300,
            ],
        ];
        RecipeDetail::insert($data);
        
        $data = [
            [
                'recipe_id' => 5,
                'ingredient_id' => 32,
                'quantity' => 100,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 37,
                'quantity' => 1,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 8,
                'quantity' => 3,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 18,
                'quantity' => 80,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 7,
                'quantity' => 0.25,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 20,
                'quantity' => 40,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 16,
                'quantity' => 40,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 1,
                'quantity' => 15,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 27,
                'quantity' => 120,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 4,
                'quantity' => 1.5,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 48,
                'quantity' => 1,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 41,
                'quantity' => 280,
            ],
            [
                'recipe_id' => 5,
                'ingredient_id' => 47,
                'quantity' => 300,
            ],
        ];
        RecipeDetail::insert($data);
        
        $data = [
            [
                'recipe_id' => 6,
                'ingredient_id' => 32,
                'quantity' => 100,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 37,
                'quantity' => 0.75,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 28,
                'quantity' => 0.5,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 7,
                'quantity' => 0.25,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 21,
                'quantity' => 240,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 36,
                'quantity' => 8,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 16,
                'quantity' => 350,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 18,
                'quantity' => 200,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 27,
                'quantity' => 140,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 24,
                'quantity' => 40,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 1,
                'quantity' => 10,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 8,
                'quantity' => 3,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 40,
                'quantity' => 1,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 17,
                'quantity' => 150,
            ],
            [
                'recipe_id' => 6,
                'ingredient_id' => 31,
                'quantity' => 40,
            ],
        ];
        RecipeDetail::insert($data);
        
        $data = [
            [
                'recipe_id' => 7,
                'ingredient_id' => 32,
                'quantity' => 50,
            ],
            [
                'recipe_id' => 7,
                'ingredient_id' => 37,
                'quantity' => 0.5,
            ],
            [
                'recipe_id' => 7,
                'ingredient_id' => 18,
                'quantity' => 70,
            ],
            [
                'recipe_id' => 7,
                'ingredient_id' => 8,
                'quantity' => 3,
            ],
            [
                'recipe_id' => 7,
                'ingredient_id' => 24,
                'quantity' => 60,
            ],
            [
                'recipe_id' => 7,
                'ingredient_id' => 9,
                'quantity' => 0.5,
            ],
            [
                'recipe_id' => 7,
                'ingredient_id' => 39,
                'quantity' => 0.5,
            ],
            [
                'recipe_id' => 7,
                'ingredient_id' => 7,
                'quantity' => 0.25,
            ],
        ];
        RecipeDetail::insert($data);
        
        $data = [
            [
                'recipe_id' => 8,
                'ingredient_id' => 32,
                'quantity' => 100,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 37,
                'quantity' => 1,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 18,
                'quantity' => 220,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 7,
                'quantity' => 0.25,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 16,
                'quantity' => 40,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 21,
                'quantity' => 490,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 8,
                'quantity' => 3,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 1,
                'quantity' => 10,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 27,
                'quantity' => 80,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 5,
                'quantity' => 1,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 25,
                'quantity' => 110,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 29,
                'quantity' => 40,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 26,
                'quantity' => 40,
            ],
            [
                'recipe_id' => 8,
                'ingredient_id' => 49,
                'quantity' => 3,
            ],
        ];
        RecipeDetail::insert($data);
        
        $data = [
            [
                'recipe_id' => 9,
                'ingredient_id' => 31,
                'quantity' => 800,
            ],
            [
                'recipe_id' => 9,
                'ingredient_id' => 32,
                'quantity' => 200,
            ],
            [
                'recipe_id' => 9,
                'ingredient_id' => 44,
                'quantity' => 12,
            ],
            [
                'recipe_id' => 9,
                'ingredient_id' => 18,
                'quantity' => 190,
            ],
            [
                'recipe_id' => 9,
                'ingredient_id' => 7,
                'quantity' => 1.5,
            ],
            [
                'recipe_id' => 9,
                'ingredient_id' => 16,
                'quantity' => 200,
            ],
            [
                'recipe_id' => 9,
                'ingredient_id' => 22,
                'quantity' => 300,
            ],
            [
                'recipe_id' => 9,
                'ingredient_id' => 8,
                'quantity' => 3,
            ],
            [
                'recipe_id' => 9,
                'ingredient_id' => 27,
                'quantity' => 160,
            ],
            [
                'recipe_id' => 9,
                'ingredient_id' => 50,
                'quantity' => 60,
            ],
            [
                'recipe_id' => 9,
                'ingredient_id' => 13,
                'quantity' => 200,
            ],
            [
                'recipe_id' => 9,
                'ingredient_id' => 43,
                'quantity' => 300,
            ],
            [
                'recipe_id' => 9,
                'ingredient_id' => 51,
                'quantity' => 20,
            ],
        ];
        RecipeDetail::insert($data);
        
        $data = [
            [
                'recipe_id' => 10,
                'ingredient_id' => 32,
                'quantity' => 150,
            ],
            [
                'recipe_id' => 10,
                'ingredient_id' => 16,
                'quantity' => 150,
            ],
            [
                'recipe_id' => 10,
                'ingredient_id' => 24,
                'quantity' => 150,
            ],
            [
                'recipe_id' => 10,
                'ingredient_id' => 8,
                'quantity' => 8,
            ],
            [
                'recipe_id' => 10,
                'ingredient_id' => 4,
                'quantity' => 2,
            ],
            [
                'recipe_id' => 10,
                'ingredient_id' => 7,
                'quantity' => 0.25,
            ],
            [
                'recipe_id' => 10,
                'ingredient_id' => 18,
                'quantity' => 150,
            ],
            [
                'recipe_id' => 10,
                'ingredient_id' => 10,
                'quantity' => 1,
            ],
        ];
        RecipeDetail::insert($data);
        
        $data = [
            [
                'recipe_id' => 11,
                'ingredient_id' => 32,
                'quantity' => 100,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 28,
                'quantity' => 0.5,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 7,
                'quantity' => 0.25,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 21,
                'quantity' => 240,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 37,
                'quantity' => 18,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 16,
                'quantity' => 350,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 18,
                'quantity' => 200,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 27,
                'quantity' => 140,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 24,
                'quantity' => 40,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 1,
                'quantity' => 10,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 8,
                'quantity' => 3,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 40,
                'quantity' => 1,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 17,
                'quantity' => 150,
            ],
            [
                'recipe_id' => 11,
                'ingredient_id' => 31,
                'quantity' => 40,
            ],
        ];
        RecipeDetail::insert($data);
        
        $data = [
            [
                'recipe_id' => 12,
                'ingredient_id' => 32,
                'quantity' => 100,
            ],
            [
                'recipe_id' => 12,
                'ingredient_id' => 38,
                'quantity' => 1,
            ],
            [
                'recipe_id' => 12,
                'ingredient_id' => 18,
                'quantity' => 80,
            ],
            [
                'recipe_id' => 12,
                'ingredient_id' => 7,
                'quantity' => 0.25,
            ],
            [
                'recipe_id' => 12,
                'ingredient_id' => 16,
                'quantity' => 40,
            ],
            [
                'recipe_id' => 12,
                'ingredient_id' => 21,
                'quantity' => 40,
            ],
            [
                'recipe_id' => 12,
                'ingredient_id' => 8,
                'quantity' => 3,
            ],
            [
                'recipe_id' => 12,
                'ingredient_id' => 1,
                'quantity' => 10,
            ],
            [
                'recipe_id' => 12,
                'ingredient_id' => 27,
                'quantity' => 80,
            ],
            [
                'recipe_id' => 12,
                'ingredient_id' => 4,
                'quantity' => 1,
            ],
            [
                'recipe_id' => 12,
                'ingredient_id' => 45,
                'quantity' => 300,
            ],
            [
                'recipe_id' => 12,
                'ingredient_id' => 47,
                'quantity' => 350,
            ],
        ];
        RecipeDetail::insert($data);
        
    }
}
