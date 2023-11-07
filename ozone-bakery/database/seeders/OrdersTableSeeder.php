<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1, // Replace with an existing user's ID
                'status' => 'Waiting',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Replace with another existing user's ID
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Replace with another existing user's ID
                'status' => 'failed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more order data as needed
        ];

        // Insert the data into the orders table
        Order::insert($data);
    }
}
