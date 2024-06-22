<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('treatments')->insert([
            [
                'name' => 'Haircut',
                'desc' => 'Potong rambut mantap',
                'price' => '120-250k',
                'image' => '',
            ],
            [
                'name' => 'SPA',
                'desc' => 'Pijat badanmu untuk melancarkan peredaran darah',
                'price' => '300-500k',
                'image' => '',
            ],
        ]);
    }
}
