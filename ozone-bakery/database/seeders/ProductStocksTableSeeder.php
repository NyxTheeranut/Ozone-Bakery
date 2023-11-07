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
                'product_id' => 3, // Replace with an existing product's ID
                'amount' => 100,
                'exp_date' => Carbon::now()->addDays(7),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5, // Replace with another existing product's ID
                'amount' => 50,
                'exp_date' => Carbon::now()->addDays(15),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more product stock data as needed
        ];

        // Insert the data into the product_stocks table
        ProductStock::insert($data);
    }
}
