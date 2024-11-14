<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Amenities extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenity = [
            [
                'amenity_name' => 'Aircon',
                'amenity_status' => 0,
            ],
            [
                'amenity_name' => 'Wifi',
                'amenity_status' => 0,
            ],
            [
                'amenity_name' => 'Ventilator',
                'amenity_status' => 0,
            ],
            [
                'amenity_name' => 'Exhaust Fan',
                'amenity_status' => 0,
            ],
        ];

        foreach ($amenity as $amenities) {
            \App\Models\Amenities::create($amenities);
        }
    }
}
