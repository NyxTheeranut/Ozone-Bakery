<?php

namespace Database\Seeders;

use App\Models\MadeToOrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MadeToOrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'made_to_order_id' => 1,
                'product_id' => 1,
                'amount' => 1,
            ],
            [
                'made_to_order_id' => 1,
                'product_id' => 2,
                'amount' => 2,
            ],
            [
                'made_to_order_id' => 2,
                'product_id' => 3,
                'amount' => 3,
            ],
            [
                'made_to_order_id' => 2,
                'product_id' => 4,
                'amount' => 4,
            ],
        ];

        MadeToOrderDetail::insert($data);
    }
}
