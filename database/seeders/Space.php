<?php

namespace Database\Seeders;

use App\Models\AmenitySelected;
use App\Models\LeasableInfoModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Space extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $space = [
            [
                "space_name" => "small space",
                "space_area" => "15.0",
                "mall_code" => "DVO",
                "bldg_number" => "B1",
                "unit_number" => "1",
                "level_number" => "L1",
                "store_type" => "FOOD",
                "property_code" => "DVOB1L11",
                "space_type" => "Fixed Rental",
                "location" => "Prime Space",
                "remarks" => "Super Large Supermarket Space",
                "space_img" => null
            ],
            [
                "space_name" => "medium space",
                "space_area" => "15.0",
                "mall_code" => "DGS",
                "bldg_number" => "B1",
                "unit_number" => "2",
                "level_number" => "L1",
                "store_type" => "RETAIL",
                "property_code" => "DGSB1L12",
                "space_type" => "Percentage Rental",
                "location" => "Prime Space",
                "remarks" => "Super Large Supermarket Space",
                "space_img" => null
            ]
        ];

        $leasable_space = [
            [
                'space_id' => "1",
                'owner_id' => null,
                'status' => "0"
            ],
            [
                'space_id' => "2",
                'owner_id' => null,
                'status' => "0"
            ],
        ];

        $amenities = [
            [
                "amenity_id" => "1",
                "space_id" => "1",
            ],
            [
                "amenity_id" => "2",
                "space_id" => "1",
            ],
            [
                "amenity_id" => "3",
                "space_id" => "1",
            ],
            [
                "amenity_id" => "4",
                "space_id" => "1",
            ],
            [
                "amenity_id" => "1",
                "space_id" => "2",
            ],
            [
                "amenity_id" => "2",
                "space_id" => "2",
            ],
            [
                "amenity_id" => "3",
                "space_id" => "2",
            ],
            [
                "amenity_id" => "4",
                "space_id" => "2",
            ],
        ];
        
        // foreach($space as $spaces){
        //     \App\Models\Space::create($spaces);
        // }

        // foreach($amenities as $amenity){
        //     AmenitySelected::create($amenity);
        // }

        // foreach($leasable_space as $lease_space){
        //     LeasableInfoModel::create($lease_space);
        // }
    }
}
