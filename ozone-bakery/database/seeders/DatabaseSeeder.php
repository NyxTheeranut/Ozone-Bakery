<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Queue;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductStocksTableSeeder::class);
        $this->call(OrderDetailsTableSeeder::class);
        $this->call(RecipesTableSeeder::class);
        $this->call(IngredientsTableSeeder::class);
        $this->call(RecipeDetailsTableSeeder::class);
        $this->call(MadeToOrdersTableSeeder::class);
        //$this->call(CartTableSeeder::class);
        $this->call(MadeToOrderDetailSeeder::class);

        $queue = new Queue();
        $queue->date = Carbon::now()->format('Y-m-d');
        $queue->save();
    }
}
