<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'product_id' => 1,
                'yield' => 4,
                'duration' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'yield' => 2,
                'duration' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Recipe::insert($data);
    }
}
