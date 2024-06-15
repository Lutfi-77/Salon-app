<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            ],
            // [
            //     'name' => 'customer',
            //     'email' => 'customer@gmail.com',
            //     'password' => Hash::make('customer'),
            //     'role' => 'customer',
            // ],
            // [
            //     'name' => 'worker',
            //     'email' => 'worker@gmail.com',
            //     'password' => Hash::make('worker'),
            //     'role' => 'worker',
            // ]
        ]);
    }
}
