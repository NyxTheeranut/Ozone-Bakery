<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the storage seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Banana Cake',
                'price' => 10,
                'image_path' => '/storage/image/product/1.jpg',
                'description' => 'Hey! Nice piece of cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brownie Cube',
                'price' => 35,
                'image_path' => '/storage/image/product/2.jpg',
                'description' => 'Hey! Nice piece of muffin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chocolate Fudge Cake',
                'price' => 30,
                'image_path' => '/storage/image/product/3.jpg',
                'description' => 'Hey! Nice piece of croissant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coconut Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/4.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coconut Cake Egg FLoss',
                'price' => 35,
                'image_path' => '/storage/image/product/5.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grean Tea Fudge Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/6.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mamon Cake Egg FLoss',
                'price' => 20,
                'image_path' => '/storage/image/product/7.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Orange Fudge Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/8.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sausage Bun',
                'price' => 12,
                'image_path' => '/storage/image/product/9.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Taiwanese Castella Cake',
                'price' => 25,
                'image_path' => '/storage/image/product/10.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thai Tea Fudge',
                'price' => 35,
                'image_path' => '/storage/image/product/11.jpg',
                'description' => 'Hey! Nice piece cake',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vanilla Strawberry Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/12.jpg',
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
