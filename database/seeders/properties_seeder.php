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
        $csvFile = fopen(base_path('database/data/Full.csv'), 'r');
        $firstLine = true;

        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            if (!$firstLine) {
                Property::create(
                    [
                        'id'=>$data['19'],
                        'pType_id' => $data['1'],
                        'amenities_id' => $data['17'],
                        'property_name' => $data['0'],
                        'property_slug' => $data['18'],
                        'property_code' => $data['19'],
                        'property_status' => $data['20'],
                        'lowest_price' => $data['8'],
                        'house_mortgage' => $data['22'],
                        'rent' => $data['21'],
                        'property_thumbnail' => $data['23'],
                        'short_desc' => $data['24'],
                        'long_desc' => $data['16'],
                        'bedrooms' => $data['7'],
                        'bathrooms' => $data['25'],
                        'garage' => $data['14'],
                        'foundation_size' => $data['33'],
                        'property_size' => $data['3'],
                        'property_video' => $data['26'],
                        'address' => $data['4'],
                        'latitude' => $data['27'],
                        'longitude' => $data['28'],
                        'featured' => $data['29'],
                        'hot' => $data['30'],
                        'agent_id' => $data['31'],
                        'status' => $data['32'],
                        'tedadTabaghe' => $data['2'],
                        'tedadKoleTabaghat' => $data['5'],
                        'TabagheDarVahed' => $data['6'],
                        'VaziatBana' => $data['9'],
                        'Jahat' => $data['10'],
                        'nama' => $data['11'],
                        'KafPush' => $data['12'],
                        'ServiceKitchen' => $data['13'],
                        'VorudiMoshtarak' => $data['15'],
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