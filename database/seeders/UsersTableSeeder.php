<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {       
        DB::table('users')->insert([
            //  Admin 
            [
                'name' => 'MellkGostarAdmin',
                'username' => 'MellkGostarAdmin',
                'email' => 'alssfard@gmail.com',
                'password' => Hash::make('F@rd9231'),
                'role' => 'admin',
                'status' => 'active',
            ],
        ]);
    }
}
