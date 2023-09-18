<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MultiImage;
use Carbon\Carbon;

class multiImages_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MultiImage::truncate();
        $csvFile = fopen(base_path('database/data/finallyDoneMultiImages.csv'), 'r');
        $firstLine = true;

        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            if (!$firstLine) {
                MultiImage::create(
                    [
                        'id' => $data['0'],
                        'property_id' => $data['1'],
                        'photo_name' => $data['2'],
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