<?php

namespace Database\Seeders;

use App\Models\UtilitiesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Utility extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $utility = [
            [
                'utility_name' => 'Water',
                'utility_type' => 'Water Utility',
                'utility_description' => 'Test',
                'utility_price' => '2500'
            ],
            [
                'utility_name' => 'Electricity',
                'utility_type' => 'Electricity Utility',
                'utility_description' => 'Test',
                'utility_price' => '2400'
            ],
        ];

        foreach ($utility as $util) {
            UtilitiesModel::create($util);
        }
    }
}
