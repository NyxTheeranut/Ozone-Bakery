<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'order_id' => 1, // Replace with an existing order's ID
                'product_id' => 1, // Replace with an existing product's ID
                'amount' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2, // Replace with another existing order's ID
                'product_id' => 2, // Replace with another existing product's ID
                'amount' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more order detail data as needed
        ];

        // Insert the data into the order_details table
        OrderDetail::insert($data);
    }
}
