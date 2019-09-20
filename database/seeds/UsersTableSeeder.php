<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'name'          => '坂田 聖史',
                'slack_user_id' => 'AAAAAAAAA',
                'email'         => 'hoge@gmail.com',
                'avatar'        => null,
                'created_at'    => Carbon::create(2017, 12, 3),
            ],
            [
                'name'          => 'Daichi Ando',
                'slack_user_id' => 'U5L6XL5KJ',
                'email'         => 'a24arc.ad@gmail.com',
                'avatar'        => 'https://avatars.slack-edge.com/2019-01-11/521652138498_a80d324258d73c87ad2e_192.jpg',
                'created_at'    => Carbon::create(2017, 4, 3),
            ],
            [
                'name'          => '金谷 翔平',
                'slack_user_id' => 'CCCCCCCCC',
                'email'         => 'foo@gmail.com',
                'avatar'        => null,
                'created_at'    => Carbon::create(2017, 7, 16),
            ],
            [
                'name'          => '五島 晃希',
                'slack_user_id' => 'DDDDDDDDD',
                'email'         => 'moo@gmail.com',
                'avatar'        => null,
                'created_at'    => Carbon::create(2017, 3, 16),
            ],
            [
                'name'          => '田中 まさし',
                'slack_user_id' => 'EEEEEEEEE',
                'email'         => 'doo@gmail.com',
                'avatar'        => null,
                'created_at'    => Carbon::create(2017, 2, 01),
            ],
            [
                'name'          => '室 剛',
                'slack_user_id' => 'FFFFFFFFF',
                'email'         => 'goo@gmail.com',
                'avatar'        => null,
                'created_at'    => Carbon::create(2017, 6, 15),
            ],
            [
                'name'          => '菅原 まひろ',
                'slack_user_id' => 'GGGGGGGGG',
                'email'         => 'woo@gmail.com',
                'avatar'        => null,
                'created_at'    => Carbon::create(2017, 3, 27),
            ]
        ]);
    }
}

