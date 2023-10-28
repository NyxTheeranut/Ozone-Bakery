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
                'name' => 'Banana Cake',
                'price' => 10,
                'image_path' => 'image/product/bananacake.jpg',
                'description' => 'Hey! Nice piece of cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brownie Cube',
                'price' => 35,
                'image_path' => 'image/product/browniecube.jpg',
                'description' => 'Hey! Nice piece of muffin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chocolate Fudge Cake',
                'price' => 30,
                'image_path' => 'image/product/chocolatefudge.jpg',
                'description' => 'Hey! Nice piece of croissant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coconut Cake',
                'price' => 35,
                'image_path' => 'image/product/coconutcake.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coconut Cake Egg FLoss',
                'price' => 35,
                'image_path' => 'image/product/coconutegg.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grean Tea Fudge Cake',
                'price' => 35,
                'image_path' => 'image/product/greenteafudge.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mamon Cake Egg FLoss',
                'price' => 20,
                'image_path' => 'image/product/mamonegg.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Orange Fudge Cake',
                'price' => 35,
                'image_path' => 'image/product/orangefudge.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sausage Bun',
                'price' => 12,
                'image_path' => 'image/product/sausagebun.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Taiwanese Castella Cake',
                'price' => 25,
                'image_path' => 'image/product/tiwanegg.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thai Tea Fudge',
                'price' => 35,
                'image_path' => 'image/product/thaiteafudge.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vanilla Strawberry Cake',
                'price' => 35,
                'image_path' => 'image/product/vanillastrawberry.jpg',
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
