<?php
namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Property_Types extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('property_types')->insert([
            [
                'id' => '1',
                'type_name' => 'مسکونی',
                'type_icon' => 'upload/p_Types/house.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '2',
                'type_name' => 'زمین',
                'type_icon' => 'upload/p_Types/land.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '3',
                'type_name' => 'باغ ویلایی',
                'type_icon' => 'upload/p_Types/villa.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '4',
                'type_name' => 'باغ',
                'type_icon' => 'upload/p_Types/houseGarden.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '5',
                'type_name' => 'تجاری',
                'type_icon' => 'upload/p_Types/businessOffice.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '6',
                'type_name' => 'آپارتمان',
                'type_icon' => 'upload/p_Types/apartment.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '7',
                'type_name' => 'زمین کشاورزی',
                'type_icon' => 'upload/p_Types/agricultural_land.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '8',
                'type_name' => 'انبار',
                'type_icon' => 'upload/p_Types/Store.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}