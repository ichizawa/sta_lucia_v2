<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Charge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Charges extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $charges = [
            [
                'charge_name' => 'CUSA per SQM',
                'charge_fee' => 500,
                'frequency' => 'MONTHLY',
            ],
            [
                'charge_name' => 'CUSA FIXED',
                'charge_fee' => 500,
                'frequency' => 'MONTHLY',
            ],
        ];

        foreach ($charges as $charge) {
            Charge::create($charge);
        }
        
    }
}
