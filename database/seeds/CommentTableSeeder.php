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
            ],
            [
                'user_id' => 4,
                'question_id' => 1,
                'content' => 'wwwwwwww',
            ],
            [
                'user_id' => 4,
                'question_id' => 2,
                'content' => 'xxxxxxxxx',
            ],
        ]);
    }
}
