<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = new User();
        $user->name = 'หมิวหมิว';
        $user->lastname = 'หมิวหมิว';
        $user->tel = '0987654321';
        $user->email = 'mute@example.com';
        $user->password = 'mute';
        $user->is_admin = 0;
        $user->save();

        $user = new User();
        $user->name = 'smart';
        $user->lastname = 'art';
        $user->tel = '0987654322';
        $user->email = 'smart@example.com';
        $user->password = 'smart';
        $user->is_admin = 1;
        $user->save();

        // $data = [
        //     [
        //         'name' => 'Kan',
        //         'lastname' => 'Sriprapai',
        //         'tel' => '0931503337',
        //         'email' => 'gunkspp1511@gmail.com',
        //         'password' => Hash::make('12345678'),
        //         'is_admin' => 0,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ];

        // DB::table('users')->insert($data);

    }
}
