<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Product A',
                'price' => 25,
                'image_path' => 'image/product/clinkers-cake-173208-2.jpg',
                'description' => 'Hey! Nice piece of cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product B',
                'price' => 35,
                'image_path' => 'image/product/muffin.jpg',
                'description' => 'Hey! Nice piece of muffin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product c',
                'price' => 38,
                'image_path' => 'image/product/croissant.jpg',
                'description' => 'Hey! Nice piece of croissant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product d',
                'price' => 65,
                'image_path' => 'image/product/default.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product e',
                'price' => 42,
                'image_path' => 'image/product/default.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product f',
                'price' => 38,
                'image_path' => 'image/product/default.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product g',
                'price' => 75,
                'image_path' => 'image/product/default.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product h',
                'price' => 95,
                'image_path' => 'image/product/default.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product i',
                'price' => 32,
                'image_path' => 'image/product/default.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more product data as needed
        ];

        // Insert the data into the products table
        Product::insert($data);
    }
}
