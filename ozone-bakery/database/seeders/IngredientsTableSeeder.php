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
            [//1
                'name' => 'แป้งบัวแดง',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [//2
                'name' => 'กล้วยหอมบด',
                'quantity_unit' => 'pieces',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [//3
                'name' => 'กลิ่นกล้วยหอม',
                'quantity_unit' => 'tea spoon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [//4
                'name' => 'กลิ่นวานิลลา',
                'quantity_unit' => 'tea spoon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //5
                'name' => 'กลิ่นส้ม',
                'quantity_unit' => 'tea spoon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //6
                'name' => 'กะทิ',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //7
                'name' => 'Sp',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //8
                'name' => 'เกลือ',
                'quantity_unit' => 'tea spoon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //9
                'name' => 'ไข่ไก่',
                'quantity_unit' => 'fong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //10
                'name' => 'ออริกาโน่',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //11
                'name' => 'ครีมออฟทาทาร์',
                'quantity_unit' => 'tea spoon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //12
                'name' => 'ช็อกโกแลคชิป',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //13
                'name' => 'ช็อกโกแลต(Compound)',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //15
                'name' => 'ซอสมะเขือเทศ',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //16
                'name' => 'ดาร์กช็อกโกแลต(70%)',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //17
                'name' => 'นมสดจืด',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //18
                'name' => 'นมข้นจืด',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //19
                'name' => 'นมสด',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //20
                'name' => 'น้ำตาลทรายขาว',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //21
                'name' => 'น้ำตาลเบเกอรี่',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //22
                'name' => 'น้ำใบเตย',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //23
                'name' => 'น้ำเปล่า',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //24
                'name' => 'น้ำเปล่า(เย็น)',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //25
                'name' => 'น้ำมะพร้าว',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //26
                'name' => 'น้ำมันพืช',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //27
                'name' => 'น้ำส้มซันควิก',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //28
                'name' => 'เนยเค็ม',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //29
                'name' => 'เนยจืด',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //30
                'name' => 'เบกกิ้งโซดา',
                'quantity_unit' => 'tea spoon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //31
                'name' => 'แป้งกวนไส้',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //32
                'name' => 'แป้งขนมปัง',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //33
                'name' => 'แป้งข้าวโพด',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //34
                'name' => 'แป้งเค้ก',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //35
                'name' => 'แป้งอเนกประสงค์',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //36
                'name' => 'ผงโกโก้',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //37
                'name' => 'ผงชาเขียว',
                'quantity_unit' => 'tea spoon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //38
                'name' => 'ผงชาไทย',
                'quantity_unit' => 'tea spoon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //39
                'name' => 'ผงฟู',
                'quantity_unit' => 'tea spoon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //40
                'name' => 'ผงวานิลลา',
                'quantity_unit' => 'tea spoon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //41
                'name' => 'ผงวุ้น',
                'quantity_unit' => 'tea spoon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //42
                'name' => 'ฝอยทอง',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //43
                'name' => 'มะพร้าวอ่อนขูด',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //44
                'name' => 'มายองเนส',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //45
                'name' => 'ยีสต์',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //46
                'name' => 'แยมสตรอว์เบอรรี่',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //47
                'name' => 'โยเกิร์ต',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //48
                'name' => 'วิปครีม',
                'quantity_unit' => 'grams',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //49
                'name' => 'สีผสมอาหาร(เขียวแอปเปิ้ล)',
                'quantity_unit' => 'tea spoon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //50
                'name' => 'สีผสมอาหาร(ส้ม)',
                'quantity_unit' => 'drops',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //51
                'name' => 'ไส้กรอก',
                'quantity_unit' => 'pieces',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ];

        Ingredient::insert($data);
    }
}
