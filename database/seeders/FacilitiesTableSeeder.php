<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facilities')->insert([
            //  1
            [
                'name' => 'Удобство 1',
            ],
            //  2
            [
                'name' => 'Удобство 2',
            ],
            //  3
            [
                'name' => 'Удобство 3',
            ],
            //  4
            [
                'name' => 'Удобство 4',
            ],
            //  5
            [
                'name' => 'Удобство 5',
            ],
            //  6
            [
                'name' => 'Удобство 6',
            ],
            //  7
            [
                'name' => 'Удобство 7',
            ],
            //  8
            [
                'name' => 'Удобство 8',
            ],

        ]);
    }
}
