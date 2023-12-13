<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            //  1
            [
                'name' => 'Комната 1',
                'description' => 'Комната 1 уютная',
                'poster_url' => '/image/front/room-img1.jpg',
                'floor_area' => 9.00,
                'type' => 'Тип 1',
                'price' => 500.00,
                'hotel_id' => 1,
            ],
            //  2
            [
                'name' => 'Комната 2',
                'description' => 'Комната 2 уютная',
                'poster_url' => '/image/front/room-img2.jpg',
                'floor_area' => 90.00,
                'type' => 'Тип 2',
                'price' => 600.00,
                'hotel_id' => 1,
            ],
            //  3
            [
                'name' => 'Комната 3',
                'description' => 'Комната 3 уютная',
                'poster_url' => '/image/front/room-img3.jpg',
                'floor_area' => 2.00,
                'type' => 'Тип 3',
                'price' => 1500.00,
                'hotel_id' => 2,
            ],
            //  4
            [
                'name' => 'Комната 4',
                'description' => 'Комната 4 уютная',
                'poster_url' => '/image/front/room-img4.jpg',
                'floor_area' => 5.00,
                'type' => 'Тип 4',
                'price' => 150.00,
                'hotel_id' => 2,
            ],
            //  5
            [
                'name' => 'Комната 5',
                'description' => 'Комната 5 уютная',
                'poster_url' => '/image/front/room-img5.jpg',
                'floor_area' => 5.00,
                'type' => 'Тип 5',
                'price' => 1000.00,
                'hotel_id' => 3,
            ],
            //  6
            [
                'name' => 'Комната 6',
                'description' => 'Комната 6 уютная',
                'poster_url' => '/image/front/room-img6.jpg',
                'floor_area' => 9.00,
                'type' => 'Тип 6',
                'price' => 10000.00,
                'hotel_id' => 3,
            ],
            //  7
            [
                'name' => 'Комната 7',
                'description' => 'Комната 7 уютная',
                'poster_url' => '/image/front/room-img7.jpg',
                'floor_area' => 7.00,
                'type' => 'Тип 7',
                'price' => 7000.00,
                'hotel_id' => 4,
            ],
            //  8
            [
                'name' => 'Комната 8',
                'description' => 'Комната 8 уютная',
                'poster_url' => '/image/front/room-img8.jpg',
                'floor_area' => 3.00,
                'type' => 'Тип 8',
                'price' => 35000.00,
                'hotel_id' => 4,
            ],
        ]);
    }
}
