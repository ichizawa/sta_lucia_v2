<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            [
                'category_id' => 1,
                'name' => 'Pastry',
            ],
            [
                'category_id' => 2,
                'name' => 'Woords',
            ],
        ];

        foreach ($category as $cat) {
            \App\Models\SubCategory::create($cat);
        }
    }
}
