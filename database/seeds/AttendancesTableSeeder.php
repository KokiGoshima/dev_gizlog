<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendances')->truncate();
        $faker = Faker::create('ja_JP');
        $date = Carbon::today();
        $attributes = [];
        for ($i = 0; $i < 100; $i++) {
            $attributes[] = [
                'user_id' => $faker->numberBetween($min = 1, $max = 8),
                'date' => $date->format('Y-m-d'),
                'start_time' => $date->format('Y-m-d') . ' ' . '09:54:15',
                'end_time' => $date->format('Y-m-d') . ' ' . '19:04:15',
                'absence_reason' => null,
                'correction_reason' => null,
                'absence_flag' => 0,
                'correction_flag' => 0,
            ];
            $date->subDay();
        }

        for ($i = 0; $i < 100; $i++) {
            $attributes[] = [
                'user_id' => $faker->numberBetween($min = 1, $max = 8),
                'date' => $date->format('Y-m-d'),
                'start_time' => $date->format('Y-m-d') . ' ' . '09:54:15',
                'end_time' => null,
                'absence_reason' => null,
                'correction_reason' => null,
                'absence_flag' => 0,
                'correction_flag' => 0,
            ];
            $date->subDay();
        }

        DB::table('attendances')->insert($attributes);
    }
}
