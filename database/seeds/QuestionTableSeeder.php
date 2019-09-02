<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->truncate();
        DB::table('questions')->insert([
            [
                'user_id' => 1,
                'tag_category_id' => 1,
                'title' => 'test',
                'content' => 'testes',
            ],
            [
                'user_id' => 1,
                'tag_category_id' => 2,
                'title' => 'hoge',
                'content' => 'hogehoge',
            ],
            [
                'user_id' => 2,
                'tag_category_id' => 3,
                'title' => 'moge',
                'content' => 'mogemoge',
            ],
        ]);
    }
}
