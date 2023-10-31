<?php

namespace Database\Seeders;

use App\Models\MadeToOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MadeToOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1, // Replace with valid user_id
                'recipe_id' => 1, // Replace with valid recipe_id
                'price' => 50,
                'order_status' => 'Pending',
                'pickup_date' => now()->addDays(3),
                'description' => 'Description for order 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Replace with valid user_id
                'recipe_id' => 2, // Replace with valid recipe_id
                'price' => 45,
                'order_status' => 'Evaluating',
                'pickup_date' => now()->addDays(5),
                'description' => 'Description for order 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        MadeToOrder::insert($data);
    }
}
