<?php

namespace Database\Seeders;

use App\Models\User;
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
        ];

       
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
