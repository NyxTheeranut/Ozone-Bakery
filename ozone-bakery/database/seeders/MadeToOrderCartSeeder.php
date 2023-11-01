<?php

namespace Database\Seeders;

use App\Models\MadeToOrderCart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MadeToOrderCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1, // Replace with valid user_id
                'product_id' => 1, // Replace with valid product_id
                'amount' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1, // Replace with valid user_id
                'product_id' => 2, // Replace with valid product_id
                'amount' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Replace with valid user_id
                'product_id' => 3, // Replace with valid product_id
                'amount' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Replace with valid user_id
                'product_id' => 4, // Replace with valid product_id
                'amount' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        MadeToOrderCart::insert($data);
    }
}
