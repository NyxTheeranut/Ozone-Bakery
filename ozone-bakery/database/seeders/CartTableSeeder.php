<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'product_id' => 1,
                'amount' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'product_id' => 2,
                'amount' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Cart::insert($data);
    }
}
