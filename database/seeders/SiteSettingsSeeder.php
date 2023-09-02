<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_settings')->insert([

            'id' => '1',
            'logo' => 'upload/logo/1775858890451856.png',
            'support_phone' => 'خرید و فروش: ۰۹۱۳۳۳۱۰۳۳۷',
            'company_address' => 'آدرس: اصفهان، نجف آباد، بلوار منتظری شمالی، نبش کوچه امینی',
            'email' => 'support@mellkgostar.ir',
            'facebook' => '#',
            'twitter' => '#',
            'copyright' => '#',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}