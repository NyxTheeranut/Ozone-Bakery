<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Ingredient A',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ingredient B',
                'quantity_unit' => 'pieces',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Ingredient::insert($data);
    }
}
