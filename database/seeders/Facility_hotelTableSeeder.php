<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Facility_hotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facility_hotel')->insert([
            //  1
            [
                'facility_id' => 1,
                'hotel_id' => 1,
            ],
            //  2
            [
                'facility_id' => 2,
                'hotel_id' => 1,
            ],
            //  3
            [
                'facility_id' => 3,
                'hotel_id' => 2,
            ],
            //  4
            [
                'facility_id' => 4,
                'hotel_id' => 3,
            ],
            //  5
            [
                'facility_id' => 5,
                'hotel_id' => 4,
            ],
        ]);
    }
}
