<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(properties_seeder::class);
        $this->call(SiteSettingsSeeder::class);
        $this->call(Property_Types::class);
        $this->call(Amenities_Seeder::class);
        //$this->call(multiImages_Seeder::class);
        //\App\Models\User::factory(5)->create();
    }
}