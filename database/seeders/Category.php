<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            [
                'name' => 'Food',
            ],
            [
                'name' => 'Hardware',
            ],
        ];

        foreach ($category as $cat) {
            Categories::create($cat);
        }
    }
}
