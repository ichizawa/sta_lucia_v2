<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentsTable;

class Documents extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            ['document_name' => 'dti_reg'],
            ['document_name' => 'valid_id1'],
            ['document_name' => 'valid_id2'],
            ['document_name' => 'sec_reg'],
            ['document_name' => 'valid_idSig1'],
            ['document_name' => 'valid_idSig2'],
            ['document_name' => 'bir_cor'],
            ['document_name' => 'comp_prof'],
            ['document_name' => 'menu_list'],
            ['document_name' => 'store_persp'],
            ['document_name' => 'franch_letter'],
            ['document_name' => 'car_letter'],
            ['document_name' => 'service_letter'],
            ['document_name' => 'realty_letter'],
            ['document_name' => 'hlurb'],
        ];

        // Temporarily disable timestamps
        // DocumentsTable::withoutTimestamps(function () use ($documents) {
        //     foreach ($documents as $document) {
        //         DocumentsTable::create($document);
        //     }
        // });
    }
}
