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
                'image_path' => '/storage/image/product/bananacake.jpg',
                'description' => 'A moist and flavorful cake made with ripe bananas, often with a hint of cinnamon or nuts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brownie Cube',
                'price' => 35,
                'image_path' => '/storage/image/product/browniecube.jpg',
                'description' => 'A dense and rich square-shaped chocolate dessert, resembling a brownie, but with a slightly different texture.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chocolate Fudge Cake',
                'price' => 30,
                'image_path' => '/storage/image/product/chocolatefudge.jpg',
                'description' => 'A decadent, moist chocolate cake with a smooth and thick layer of fudge icing.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coconut Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/coconutcake.jpg',
                'description' => 'A sweet and tropical cake infused with coconut flavor, typically covered in coconut flakes.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Coconut Cake Egg FLoss',
                'price' => 35,
                'image_path' => '/storage/image/product/coconutegg.jpg',
                'description' => 'A variation of coconut cake topped with a delicate and crispy egg floss for added texture and flavor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grean Tea Fudge Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/greenteafudge.jpg',
                'description' => 'A cake infused with the earthy and slightly bitter taste of green tea, combined with a creamy fudge topping.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mamon Cake Egg FLoss',
                'price' => 20,
                'image_path' => '/storage/image/product/mamonegg.jpg',
                'description' => 'A cake with a delicate, airy texture, often with an egg floss topping, popular in Filipino cuisine.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Orange Fudge Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/orangefudge.jpg',
                'description' => 'A zesty and moist cake with a rich fudge icing, featuring a burst of orange flavor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sausage Bun',
                'price' => 12,
                'image_path' => '/storage/image/product/sausagebun.jpg',
                'description' => 'A savory pastry that contains a sausage or sausage-like filling, often enjoyed as a quick snack or breakfast.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Taiwanese Castella Cake',
                'price' => 25,
                'image_path' => '/storage/image/product/taiwanegg.jpg',
                'description' => 'A fluffy and sponge-like cake with origins in Taiwan, typically sweet and enjoyed with various toppings.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thai Tea Fudge',
                'price' => 35,
                'image_path' => '/storage/image/product/thaiteafudge.jpg',
                'description' => 'A fudgy dessert infused with the unique flavors of Thai tea, offering a mix of sweetness and a hint of spiciness.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vanilla Strawberry Cake',
                'price' => 35,
                'image_path' => '/storage/image/product/vanillastrawberry.jpg',
                'description' => 'A delightful cake combining the classic sweetness of vanilla with the bright and refreshing taste of strawberries, often adorned with strawberry slices.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more product data as needed
        ];

        // Insert the data into the products table
        Product::insert($data);
    }
}
