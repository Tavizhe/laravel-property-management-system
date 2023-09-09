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
                'type_name' => 'ویلایی',
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
                'type_name' => 'آپارتمان همکف',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '7',
                'type_name' => 'ویلایی تجاری',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '8',
                'type_name' => 'آپارتمان',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '9',
                'type_name' => 'مسکونی متروکه',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '10',
                'type_name' => 'باغ ویلا',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '11',
                'type_name' => 'خانه باغ',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '12',
                'type_name' => 'باسکول',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '13',
                'type_name' => 'زمین باغی',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '14',
                'type_name' => 'مغازه تجاری',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '15',
                'type_name' => 'مسکونی سفتکاری',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '16',
                'type_name' => 'منزل سفتکاری',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '17',
                'type_name' => 'مستغلات',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '18',
                'type_name' => 'تجاری مسکونی',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '19',
                'type_name' => 'تجاری و مسکونی',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '20',
                'type_name' => 'زمین مزروعی',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '21',
                'type_name' => 'مسکونی دوبلکس',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '22',
                'type_name' => 'زمین تجاری',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '23',
                'type_name' => 'زمین باغی',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '24',
                'type_name' => 'زمین کشاورزی',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '25',
                'type_name' => 'اداری',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '26',
                'type_name' => 'سفتکاری',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '27',
                'type_name' => 'سوییت',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '28',
                'type_name' => 'باغ زمین',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '29',
                'type_name' => 'مسکونی معاوضه',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '30',
                'type_name' => 'انبار و مغازه',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '31',
                'type_name' => 'استبل',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '32',
                'type_name' => 'هواری',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => '33',
                'type_name' => 'انبار',
                'type_icon' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}