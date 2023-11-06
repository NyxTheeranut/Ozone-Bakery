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
                'description' => "Delicious and moist banana cake that is perfect for any occasion.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brownie Cube',
                'price' => 35,
                'image_path' => '/storage/image/product/2.jpg',
                'description' => "Indulge in rich and fudgy brownie cubes that satisfy your sweet cravings.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chocolate Fudge Cake',
                'price' => 30,
                'image_path' => '/storage/image/product/3.jpg',
                'description' => "A heavenly chocolate fudge cake that is a chocolate lover's dream come true.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coconut Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/4.jpg',
                'description' => "A delightful coconut cake that transports you to a tropical paradise with every bite.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coconut Cake Egg Floss',
                'price' => 35,
                'image_path' => '/storage/image/product/5.jpg',
                'description' => "A fusion of coconut cake and egg floss for a unique and unforgettable flavor.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Green Tea Fudge Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/6.jpg',
                'description' => "A matcha lover's dream, this green tea fudge cake is a delightful blend of flavors.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mamon Cake Egg Floss',
                'price' => 20,
                'image_path' => '/storage/image/product/7.jpg',
                'description' => "A delectable Mamon cake with a delightful egg floss topping.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Orange Fudge Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/8.jpg',
                'description' => "Treat yourself to a zesty orange fudge cake that's bursting with citrus flavors.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sausage Bun',
                'price' => 12,
                'image_path' => '/storage/image/product/9.jpg',
                'description' => "Satisfy your savory cravings with a delicious and hearty sausage bun.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Taiwanese Castella Cake',
                'price' => 25,
                'image_path' => '/storage/image/product/10.jpg',
                'description' => "Indulge in the soft and fluffy goodness of Taiwanese Castella cake.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thai Tea Fudge Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/11.jpg',
                'description' => "A tantalizing Thai tea fudge cake that's a true delight for tea lovers.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vanilla Strawberry Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/12.jpg',
                'description' => "Savor the sweet combination of vanilla and fresh strawberries in this delectable cake.",
                'created_at' => now(),
                'updated_at' => now(),
            ]
            // Add more product data as needed
        ];

        // Insert the data into the products table
        Product::insert($data);
    }
}
