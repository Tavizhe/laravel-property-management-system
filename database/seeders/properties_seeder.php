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
            if (! $firstLine) {
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
                        'max_price' => $data['8'],
                        'property_thumbnail' => $data['9'],
                        'short_desc' => $data['10'],
                        'long_desc' => $data['11'],
                        'bedrooms' => $data['12'],
                        'bathrooms' => $data['13'],
                        'garage' => $data['14'],
                        'garage_size' => $data['15'],
                        'property_size' => $data['16'],
                        'property_video' => $data['17'],
                        'address' => $data['18'],
                        'city' => $data['19'],
                        'state' => $data['20'],
                        'postal_code' => $data['21'],
                        'neighborhood' => $data['22'],
                        'latitude' => $data['23'],
                        'longitude' => $data['24'],
                        'featured' => $data['25'],
                        'hot' => $data['26'],
                        'agent_id' => $data['27'],
                        'status' => $data['28'],
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
