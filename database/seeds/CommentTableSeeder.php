<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();
        DB::table('comments')->insert([
            [
                'user_id' => 3,
                'question_id' => 1,
                'content' => 'test',
                'created_at' => '2017-12-03 10:04:23',
                'updated_at' => '2017-12-03 10:04:23',
                'deleted_at' => '2017-12-03 10:04:23',
            ],
            [
                'user_id' => 4,
                'question_id' => 1,
                'content' => 'wwwwwwww',
                'created_at' => '2017-12-03 10:04:23',
                'updated_at' => '2017-12-03 10:04:23',
                'deleted_at' => '2017-12-03 10:04:23',
            ],
            [
                'user_id' => 4,
                'question_id' => 2,
                'content' => 'xxxxxxxxx',
                'created_at' => '2017-12-03 10:04:23',
                'updated_at' => '2017-12-03 10:04:23',
                'deleted_at' => '2017-12-03 10:04:23',
            ],
        ]);
    }
}
