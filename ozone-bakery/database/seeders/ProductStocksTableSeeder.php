<?php

namespace Database\Seeders;

use App\Models\ProductStock;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductStocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'product_id' => 1, // Replace with an existing product's ID
                'amount' => 100,
                'exp_date' => Carbon::now()->addDays(30),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Replace with another existing product's ID
                'amount' => 50,
                'exp_date' => Carbon::now()->addDays(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more product stock data as needed
        ];

        // Insert the data into the product_stocks table
        ProductStock::insert($data);
    }
}
