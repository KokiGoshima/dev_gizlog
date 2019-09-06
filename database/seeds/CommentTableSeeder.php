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
                'comment' => 'test',
                'created_at' => '2017-12-03 10:04:23',
                'updated_at' => '2017-12-03 10:04:23',
                'deleted_at' => '2017-12-04 12:04:33',
            ],
            [
                'user_id' => 4,
                'question_id' => 1,
                'comment' => 'wwwwwwww',
                'created_at' => '2017-12-03 10:04:23',
                'updated_at' => '2017-12-03 10:04:23',
                'deleted_at' => '2017-12-04 10:30:23',
            ],
            [
                'user_id' => 4,
                'question_id' => 2,
                'comment' => 'xxxxxxxxx',
                'created_at' => '2017-12-03 10:04:23',
                'updated_at' => '2017-12-03 10:04:23',
                'deleted_at' => '2017-12-05 09:03:09',
            ],
        ]);
    }
}
