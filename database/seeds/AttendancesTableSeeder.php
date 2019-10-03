<?php

use Illuminate\Database\Seeder;

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
        $date = Carbon::today();
        $attributes = [];
        for ($i = 0; $i < 100; $i++) {
            $attributes[] = [
                'user_id' => 1,
                'date' => $date->format('Y-m-d'),
                'start_time' => $date->format('Y-m-d') . ' ' . '09:54:15',
                'end_time' => $date->format('Y-m-d') . ' ' . '18:54:15',
                'absence_reason' => null,
                'correction_reason' => null,
                'absence_flag' => 0,
                'correction_flag' => 1,
            ];
            $date->subDay();
        }
        DB::table('attendances')->insert($attributes);
    }
        // DB::table('attendances')->insert([
        //     [
        //         'user_id' => 1,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '09:54:15',
        //         'end_time' => null,
        //         'absence_reason' => null,
        //         'correction_reason' => null,
        //         'absence_flag' => 0,
        //         'correction_flag' => 0,
        //     ],
        //     [
        //         'user_id' => 2,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '09:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => null,
        //         'absence_flag' => 0,
        //         'correction_flag' => 0,
        //     ],
        //     [
        //         'user_id' => 3,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '09:54:15',
        //         'end_time' => null,
        //         'absence_reason' => null,
        //         'correction_reason' => null,
        //         'absence_flag' => 0,
        //         'correction_flag' => 0,
        //     ],
        //     [
        //         'user_id' => 4,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => null,
        //         'end_time' => null,
        //         'absence_reason' => '熱が出てしまいました',
        //         'correction_reason' => null,
        //         'absence_flag' => 1,
        //         'correction_flag' => 0,
        //     ],
        //     [
        //         'user_id' => 5,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '09:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '09:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => null,
        //         'absence_flag' => 0,
        //         'correction_flag' => 0,
        //     ],
        //     [
        //         'user_id' => 6,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '09:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => '出勤押し忘れました',
        //         'absence_flag' => 0,
        //         'correction_flag' => 1,
        //     ],
        //     [
        //         'user_id' => 7,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => null,
        //         'end_time' => null,
        //         'absence_reason' => '熱が出て15:00に早退しました',
        //         'correction_reason' => null,
        //         'absence_flag' => 1,
        //         'correction_flag' => 0,
        //     ],
        //     [
        //         'user_id' => 1,
        //         'date' => '2019-09-01',
        //         'start_time' => '2019-09-01 09:54:15',
        //         'end_time' => '2019-09-01 18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => null,
        //         'absence_flag' => 0,
        //         'correction_flag' => 0,
        //     ],
        //     [
        //         'user_id' => 8,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '10:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => '退勤押し忘れました。',
        //         'absence_flag' => 0,
        //         'correction_flag' => 1,
        //     ],
        //     [
        //         'user_id' => 8,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '10:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => '退勤押し忘れました。',
        //         'absence_flag' => 0,
        //         'correction_flag' => 1,
        //     ],
        //     [
        //         'user_id' => 8,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '10:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => '退勤押し忘れました。',
        //         'absence_flag' => 0,
        //         'correction_flag' => 1,
        //     ],
        //     [
        //         'user_id' => 8,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '10:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => '退勤押し忘れました。',
        //         'absence_flag' => 0,
        //         'correction_flag' => 1,
        //     ],
        //     [
        //         'user_id' => 8,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '10:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => '退勤押し忘れました。',
        //         'absence_flag' => 0,
        //         'correction_flag' => 1,
        //     ],
        //     [
        //         'user_id' => 8,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '10:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => '退勤押し忘れました。',
        //         'absence_flag' => 0,
        //         'correction_flag' => 1,
        //     ],
        //     [
        //         'user_id' => 8,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '10:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => '退勤押し忘れました。',
        //         'absence_flag' => 0,
        //         'correction_flag' => 1,
        //     ],
        //     [
        //         'user_id' => 8,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '10:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => '退勤押し忘れました。',
        //         'absence_flag' => 0,
        //         'correction_flag' => 1,
        //     ],
        //     [
        //         'user_id' => 8,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '10:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => '退勤押し忘れました。',
        //         'absence_flag' => 0,
        //         'correction_flag' => 1,
        //     ],
        //     [
        //         'user_id' => 8,
        //         'date' => Carbon::today()->format('Y-m-d'),
        //         'start_time' => Carbon::today()->format('Y-m-d'). ' '. '10:54:15',
        //         'end_time' => Carbon::today()->format('Y-m-d'). ' '. '18:54:15',
        //         'absence_reason' => null,
        //         'correction_reason' => '退勤押し忘れました。',
        //         'absence_flag' => 0,
        //         'correction_flag' => 1,
        //     ],
        // ]);
}
