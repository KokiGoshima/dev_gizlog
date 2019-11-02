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
        $attributes[] = [
            'user_id' => 1,
            'date' => $date->format('Y-m-d'),
            'start_time' => $date->format('Y-m-d') . ' ' . $faker->dateTimeBetween('09:00:00', '11:00:00')->format('H:i:s'),
            'end_time' => $date->format('Y-m-d') . ' ' . $faker->dateTimeBetween('19:00:00', '19:59:59')->format('H:i:s'),
            'absence_reason' => null,
            'correction_reason' => null,
            'absence_flag' => 0,
            'correction_flag' => 0,
        ];
        $attributes[] = [
            'user_id' => 2,
            'date' => $date->format('Y-m-d'),
            'start_time' => null,
            'end_time' => null,
            'absence_reason' => $faker->word,
            'correction_reason' => null,
            'absence_flag' => 1,
            'correction_flag' => 0,
        ];
        $attributes[] = [
            'user_id' => 3,
            'date' => $date->format('Y-m-d'),
            'start_time' => $date->format('Y-m-d') . ' ' . $faker->dateTimeBetween('10:01:00', '11:00:00')->format('H:i:s'),
            'end_time' => $date->format('Y-m-d') . ' ' . $faker->dateTimeBetween('19:00:00', '19:59:59')->format('H:i:s'),
            'absence_reason' => null,
            'correction_reason' => null,
            'absence_flag' => 0,
            'correction_flag' => 0,
        ];
        $attributes[] = [
            'user_id' => 4,
            'date' => $date->format('Y-m-d'),
            'start_time' => $date->format('Y-m-d') . ' ' . $faker->dateTimeBetween('09:00:00', '11:00:00')->format('H:i:s'),
            'end_time' => $date->format('Y-m-d') . ' ' . $faker->dateTimeBetween('19:00:00', '19:59:59')->format('H:i:s'),
            'absence_reason' => null,
            'correction_reason' => null,
            'absence_flag' => 0,
            'correction_flag' => 0,
        ];
        $attributes[] = [
            'user_id' => 5,
            'date' => $date->format('Y-m-d'),
            'start_time' => null,
            'end_time' => null,
            'absence_reason' => $faker->word,
            'correction_reason' => null,
            'absence_flag' => 1,
            'correction_flag' => 0,
        ];
        $attributes[] = [
            'user_id' => 6,
            'date' => $date->format('Y-m-d'),
            'start_time' => $date->format('Y-m-d') . ' ' . $faker->dateTimeBetween('09:00:00', '11:00:00')->format('H:i:s'),
            'end_time' => $date->format('Y-m-d') . ' ' . $faker->dateTimeBetween('19:00:00', '19:59:59')->format('H:i:s'),
            'absence_reason' => null,
            'correction_reason' => null,
            'absence_flag' => 0,
            'correction_flag' => 0,
        ];

        //     ];
        // for ($i = 0; $i < 2000; $i++) {
        //     $attributes[] = [
        //         'user_id' => $faker->numberBetween($min = 1, $max = 8),
        //         'date' => $date->format('Y-m-d'),
        //         'start_time' => $date->format('Y-m-d') . ' ' . $faker->dateTimeBetween('09:00:00', '11:00:00')->format('H:i:s'),
        //         'end_time' => $date->format('Y-m-d') . ' ' . $faker->dateTimeBetween('19:00:00', '19:59:59')->format('H:i:s'),
        //         'absence_reason' => null,
        //         'correction_reason' => null,
        //         'absence_flag' => 0,
        //         'correction_flag' => 0,
        //     ];
        //     $date->subDay(3);
        // }

        // $date = Carbon::today()->subDay();

        // for ($i = 0; $i < 2000; $i++) {
        //     $attributes[] = [
        //         'user_id' => $faker->numberBetween($min = 1, $max = 8),
        //         'date' => $date->format('Y-m-d'),
        //         'start_time' => null,
        //         'end_time' => null,
        //         'absence_reason' => $faker->word,
        //         'correction_reason' => null,
        //         'absence_flag' => 1,
        //         'correction_flag' => 0,
        //     ];
        //     $date->subDay(3);
        // }

        // $date = Carbon::today()->subDay(2);

        // for ($i = 0; $i < 2000; $i++) {
        //     $attributes[] = [
        //         'user_id' => $faker->numberBetween($min = 1, $max = 8),
        //         'date' => $date->format('Y-m-d'),
        //         'start_time' => $date->format('Y-m-d') . ' ' . $faker->dateTimeBetween('09:00:00', '11:00:00')->format('H:i:s'),
        //         'end_time' => null,
        //         'absence_reason' => null,
        //         'correction_reason' => '退勤押し忘れました。19:08に退勤しています。',
        //         'absence_flag' => 0,
        //         'correction_flag' => 1,
        //     ];
        //     $date->subDay(3);
        // }

        DB::table('attendances')->insert($attributes);
    }
}
