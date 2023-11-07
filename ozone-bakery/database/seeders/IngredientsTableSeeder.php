<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'SP', 'quantity_unit' => 'grams'], // 1
            ['name' => 'Mashed ripe bananas', 'quantity_unit' => 'grams'], // 2
            ['name' => 'Banana aroma', 'quantity_unit' => 'tsp'], // 3
            ['name' => 'Vanilla aroma', 'quantity_unit' => 'tsp'], // 4
            ['name' => 'Orange aroma', 'quantity_unit' => 'tsp'], // 5
            ['name' => 'Coconut', 'quantity_unit' => 'grams'], // 6
            ['name' => 'Salt', 'quantity_unit' => 'tsp'], // 7
            ['name' => 'Chicken eggs', 'quantity_unit' => 'pieces'], // 8
            ['name' => 'Eggs', 'quantity_unit' => 'grams'], // 9
            ['name' => 'Cream of tartar', 'quantity_unit' => 'tsp'], // 10
            ['name' => 'Chocolate chips', 'quantity_unit' => 'grams'], // 11
            ['name' => 'Chocolate (Compound)', 'quantity_unit' => 'grams'], // 12
            ['name' => 'Tomato sauce', 'quantity_unit' => 'grams'], // 13
            ['name' => 'Dark chocolate (70%)', 'quantity_unit' => 'grams'], // 14
            ['name' => 'Unsweetened condensed milk', 'quantity_unit' => 'grams'], // 15
            ['name' => 'Heavy cream', 'quantity_unit' => 'grams'], // 16
            ['name' => 'Fresh milk', 'quantity_unit' => 'grams'], // 17
            ['name' => 'White granulated sugar', 'quantity_unit' => 'grams'], // 18
            ['name' => 'Brown sugar', 'quantity_unit' => 'grams'], // 19
            ['name' => 'Pandan leaves', 'quantity_unit' => 'grams'], // 20
            ['name' => 'Water', 'quantity_unit' => 'grams'], // 21
            ['name' => 'Cold water', 'quantity_unit' => 'grams'], // 22
            ['name' => 'Coconut water', 'quantity_unit' => 'grams'], // 23
            ['name' => 'Vegetable oil', 'quantity_unit' => 'grams'], // 24
            ['name' => 'Sunquick orange juice', 'quantity_unit' => 'grams'], // 25
            ['name' => 'Salted butter', 'quantity_unit' => 'grams'], // 26
            ['name' => 'Unsalted butter', 'quantity_unit' => 'grams'], // 27
            ['name' => 'Baking soda', 'quantity_unit' => 'tsp'], // 28
            ['name' => 'Cornstarch', 'quantity_unit' => 'grams'], // 29
            ['name' => 'Corn flour', 'quantity_unit' => 'grams'], // 30
            ['name' => 'Cake flour', 'quantity_unit' => 'grams'], // 31
            ['name' => 'Red bean flour', 'quantity_unit' => 'grams'], // 32
            ['name' => 'Cornstarch', 'quantity_unit' => 'grams'], // 33
            ['name' => 'Cocoa powder', 'quantity_unit' => 'grams'], // 34
            ['name' => 'Matcha powder', 'quantity_unit' => 'tsp'], // 35
            ['name' => 'Thai tea powder', 'quantity_unit' => 'tsp'], // 36
            ['name' => 'Baking powder', 'quantity_unit' => 'tsp'], // 37
            ['name' => 'Vanilla powder', 'quantity_unit' => 'tsp'], // 38
            ['name' => 'Agar-agar powder', 'quantity_unit' => 'tsp'], // 39
            ['name' => 'Gelatin powder', 'quantity_unit' => 'tsp'], // 40
            ['name' => 'Gold thread', 'quantity_unit' => 'grams'], // 41
            ['name' => 'Grated young coconut', 'quantity_unit' => 'grams'], // 42
            ['name' => 'Mayonnaise', 'quantity_unit' => 'grams'], // 43
            ['name' => 'Yeast', 'quantity_unit' => 'grams'], // 44
            ['name' => 'Strawberry jam', 'quantity_unit' => 'grams'], // 45
            ['name' => 'Yogurt', 'quantity_unit' => 'grams'], // 46
            ['name' => 'Whipped cream', 'quantity_unit' => 'grams'], // 47
            ['name' => 'Food coloring (green apple)', 'quantity_unit' => 'tsp'], // 48
            ['name' => 'Food coloring (orange)', 'quantity_unit' => 'drops'], // 49
            ['name' => 'Sausages', 'quantity_unit' => 'pieces'], // 50
            ['name' => 'Origano', 'quantity_unit' => 'grams'], // 51
        ];


        Ingredient::insert($data);
    }
}
