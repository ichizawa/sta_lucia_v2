<?php

namespace Database\Seeders;

use App\Models\SpaceBuilding;
use App\Models\SpaceLevel;
use App\Models\SpaceMallCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MallOptions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mall = [
            [
                'mallnum' => 'DVO',
                'mallname' => 'DAVAO Mall',
                'malladdress' => 'Davao City',
                'mallimage' => null,
                'mallfacility' => 'test',
                'total_area' => '123',
                'total_available' => '123',
                'total_leased' => '123'
            ],
            [
                'mallnum' => 'DGS',
                'mallname' => 'DIGOS Mall',
                'malladdress' => 'Digos City',
                'mallimage' => null,
                'mallfacility' => 'test',
                'total_area' => '123',
                'total_available' => '123',
                'total_leased' => '123'
            ]
        ];

        $building = [
            [
                'mallid' => 1,
                'bldgnum' => 'B1',
                'bldgimage' => null
            ],
            [
                'mallid' => 2,
                'bldgnum' => 'B1',
                'bldgimage' => null
            ],
        ];

        $level = [
            [
                'bldgnumid' => 1,
                'lvlnum' => 'L1',
                'lvlimage' => null
            ],
            [
                'bldgnumid' => 2,
                'lvlnum' => 'L1',
                'lvlimage' => null
            ],
        ];

        foreach($mall as $malls){
            SpaceMallCode::create($malls);
        }

        foreach($building as $buildings){
            SpaceBuilding::create($buildings);
        }

        foreach($level as $levels){
            SpaceLevel::create($levels);
        }
    }
}
