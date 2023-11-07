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
                'yield' => 13,
            ],
            [
                'product_id' => 2,
                'yield' => 10,
            ],
            [
                'product_id' => 3,
                'yield' => 16,
            ],
            [
                'product_id' => 4,
                'yield' => 14,
            ],
            [
                'product_id' => 5,
                'yield' => 14,
            ],
            [
                'product_id' => 6,
                'yield' => 16,
            ],
            [
                'product_id' => 7,
                'yield' => 10,
            ],
            [
                'product_id' => 8,
                'yield' => 15,
            ],
            [
                'product_id' => 9,
                'yield' => 60,
            ],
            [
                'product_id' => 10,
                'yield' => 10,
            ],
            [
                'product_id' => 11,
                'yield' => 16,
            ],
            [
                'product_id' => 12,
                'yield' => 14,
            ]
        ];

        Recipe::insert($data);
    }
}
