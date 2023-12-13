<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotels')->insert([
            //  1
            [
                'name' => 'Отель 1',
                'description' => 'Отель 1 расположен в живописном месте',
                'poster_url' => '/image/front/hotel-img1.jpg',
                'address' => 'Россия Крым 1',
            ],
            //  2
            [
                'name' => 'Отель 2',
                'description' => 'Отель 2 расположен в живописном месте',
                'poster_url' => '/image/front/hotel-img2.jpg',
                'address' => 'Россия Крым 2',
            ],
            //  3
            [
                'name' => 'Отель 3',
                'description' => 'Отель 3 расположен в живописном месте',
                'poster_url' => '/image/front/hotel-img3.jpg',
                'address' => 'Россия Крым 3',
            ],
            //  4
            [
                'name' => 'Отель 4',
                'description' => 'Отель 4 расположен в живописном месте',
                'poster_url' => '/image/front/hotel-img4.jpg',
                'address' => 'Россия Крым 4',
            ],
        ]);
    }
}
