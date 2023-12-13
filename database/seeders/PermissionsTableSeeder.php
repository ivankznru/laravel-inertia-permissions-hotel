<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('permissions')->insert([
            //  1
            [
                'id' => '1',
                'name' => 'create post',
               'guard_name'=> 'web'
            ],
            //  2
            [
                'id' => '2',
                'name' => 'update post',
                'guard_name'=> 'web'
            ],
            //  3
            [

                    'id' => '3',
                    'name' => 'delete post',
                    'guard_name'=> 'web'

            ],
            //  4
            [
                'id' => '4',
                'name' => 'create facility',
                'guard_name'=> 'web'
            ],
            //  5
            [
                'id' => '5',
                'name' => 'update facility',
                'guard_name'=> 'web'
            ],
            //  6
            [

                'id' => '6',
                'name' => 'delete facility',
                'guard_name'=> 'web'

            ],
            //  7
            [
                'id' => '7',
                'name' => 'create hotel',
                'guard_name'=> 'web'
            ],
            //  8
            [
                'id' => '8',
                'name' => 'update hotel',
                'guard_name'=> 'web'
            ],
            //  9
            [
                'id' => '9',
                'name' => 'delete hotel',
                'guard_name'=> 'web'
            ],
            //  10
            [
                'id' => '10',
                'name' => 'create room',
                'guard_name'=> 'web'
            ],
            //  11
            [
                'id' => '11',
                'name' => 'update room',
                'guard_name'=> 'web'
            ],
            //  12
            [
                'id' => '12',
                'name' => 'delete room',
                'guard_name'=> 'web'
            ],
        ]);
    }
}
