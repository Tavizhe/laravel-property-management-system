<?php

namespace Database\Seeders;

use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class properties_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::truncate();
        $csvFile = fopen(base_path('database/data/finallyDone.csv'), 'r');
        $firstLine = true;

        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            if (!$firstLine) {
                Property::create(
                    [
                        'id' => $data['0'],
                        'pType_id' => $data['1'],
                        'amenities_id' => $data['2'],
                        'property_name' => $data['3'],
                        'property_slug' => $data['4'],
                        'property_code' => $data['5'],
                        'property_status' => $data['6'],
                        'lowest_price' => $data['7'],
                        'house_mortgage' => $data['8'],
                        'rent' => $data['9'],
                        'property_thumbnail' => $data['10'],
                        'short_desc' => $data['11'],
                        'long_desc' => $data['12'],
                        'bedrooms' => $data['13'],
                        'bathrooms' => $data['14'],
                        'garage' => $data['15'],
                        'foundation_size' => $data['16'],
                        'property_size' => $data['17'],
                        'property_video' => $data['18'],
                        'address' => $data['19'],
                        // 'city' => $data['20'],
                        // 'state' => $data['21'],
                        // 'postal_code' => $data['22'],
                        // 'neighborhood' => $data['23'],
                        'latitude' => $data['20'],
                        'longitude' => $data['21'],
                        'featured' => $data['22'],
                        'hot' => $data['23'],
                        'agent_id' => $data['24'],
                        'status' => $data['25'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ],
                );
            }
            $firstLine = false;
        }
        fclose($csvFile);
    }
}