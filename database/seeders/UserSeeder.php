<?php

namespace Database\Seeders;

use App\Models\BusinessType;
use App\Models\Company;
use App\Models\DocumentsTable;
use App\Models\Owner;
use App\Models\Representative;
use App\Models\TenantDocuments;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'type' => 'admin',
                'status' => '1',
                'password' => Hash::make('123456789'),
            ],
            [
                'name' => 'Bill',
                'email' => 'bill@gmail.com',
                'type' => 'bill',
                'status' => '1',
                'password' => Hash::make('123456789'),
            ],
            [
                'name' => 'Collector',
                'email' => 'collect@gmail.com',
                'type' => 'collect',
                'status' => '1',
                'password' => Hash::make('123456789'),
            ],
            [
                'name' => 'Operation',
                'email' => 'operation@gmail.com',
                'type' => 'operation',
                'status' => '1',
                'password' => Hash::make('123456789'),
            ],
            [
                'name' => 'Lease Admin',
                'email' => 'leaseadmin@gmail.com',
                'type' => 'lease',
                'status' => '1',
                'password' => Hash::make('123456789'),
            ],
            [
                'name' => 'Utility Admin',
                'email' => 'utilityadmin@gmail.com',
                'type' => 'utility',
                'status' => '1',
                'password' => Hash::make('123456789'),
            ],
            [
                'name' => 'Jon Doe',
                'email' => 'test@gmail.com',
                'type' => 'tenant',
                'status' => 0,
                'password' => Hash::make('123456789'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        $tenants = [
            [
                'owner_fname' => 'Jane',
                'owner_lname' => 'Smith',
                'owner_position' => 'CEO',
                'owner_address' => '1234 Elm Street',
                'owner_email' => 'jane.smith@example.com',
                'owner_telephone' => '1234567890',
                'owner_officehrs' => '09:00:00',
                'owner_afterofficehrs' => '06:00:00',
                'owner_mobile' => '9876543210',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        $company = [
            [
                'acc_id' => 'STA-LUCIA-25983586',
                'owner_id' => 1,
                'tenant_type' => 'Corporate',
                'company_name' => 'Fake Company',
                'store_name' => 'dsa',
                'company_address' => '1600 Fake Street',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        $category = [
            [
                'company_id' => 1,
                'category_id' => 2,
                'sub_category_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        $representative = [
            [
                'owner_id' => 1,
                'rep_fname' => 'Jon',
                'rep_lname' => 'Doe',
                'rep_position' => 'dsadsa',
                'rep_address' => '1600 Fake Street',
                'rep_email' => 'test@gmail.com',
                'rep_telephone' => '6019521325',
                'rep_officehrs' => '10:10:00',
                'rep_afterofficehrs' => '10:10:00',
                'rep_mobile' => '6019521325',
                'status' => 0,
                'password' => Hash::make('123456789'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        $documents = [
            [
                'dti_reg' => null,
                'valid_id1' => null,
                'valid_id2' => null,
                'sec_reg' => null,
                'valid_idSig1' => null,
                'valid_idSig2' => null,
                'bir_cor' => null,
                'comp_prof' => null,
                'menu_list' => null,
                'store_persp' => null,
                'franch_letter' => null,
                'car_letter' => null,
                'service_letter' => null,
                'realty_letter' => null,
                'hlurb' => null,
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        $tenant_docu = [
            [
                'owner_id' => 1,
                'document_id' => 1,
                'view' => 0,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        foreach ($tenants as $tenant) {
            Owner::create($tenant);
        }

        foreach ($company as $comp) {
            Company::create($comp);
        }

        foreach ($category as $cat) {
            BusinessType::create($cat);
        }

        foreach ($representative as $rep) {
            Representative::create($rep);
        }

        foreach ($documents as $doc) {
            DocumentsTable::create($doc);
        }

        foreach ($tenant_docu as $ten_doc) {
            TenantDocuments::create($ten_doc);
        }
    }
}
