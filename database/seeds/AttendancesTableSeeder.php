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
        DB::table('attendances')->insert([
            [
                'user_id' => 1,
                'date' => '2019-07-03',
                'start_time' => '09:54:15',
                'end_time' => null,
                'absence_reason' => null,
                'correction_reason' => null,
            ],
            [
                'user_id' => 2,
                'date' => '2019-07-03',
                'start_time' => '09:53:15',
                'end_time' => '17:54:15',
                'absence_reason' => null,
                'correction_reason' => null,
            ],
            [
                'user_id' => 3,
                'date' => '2019-07-03',
                'start_time' => '09:50:15',
                'end_time' => null,
                'absence_reason' => null,
                'correction_reason' => null,
            ],
            [
                'user_id' => 4,
                'date' => '2019-07-03',
                'start_time' => null,
                'end_time' => null,
                'absence_reason' => '熱が出てしまいました',
                'correction_reason' => null,
            ],
            [
                'user_id' => 4,
                'date' => '2019-07-04',
                'start_time' => '09:53:15',
                'end_time' => '17:54:15',
                'absence_reason' => null,
                'correction_reason' => null,
            ],
            [
                'user_id' => 5,
                'date' => '2019-07-03',
                'start_time' => '09:52:15',
                'end_time' => '18:54:15',
                'absence_reason' => null,
                'correction_reason' => '出勤押し忘れました'
            ],
            [
                'user_id' => 6,
                'date' => '2019-07-03',
                'start_time' => '09:54:15',
                'end_time' => null,
                'absence_reason' => '熱が出て15:00に早退しました',
                'correction_reason' => null,
            ],
            [
                'user_id' => 7,
                'date' => '2019-07-03',
                'start_time' => '09:30:15',
                'end_time' => '18:54:15',
                'absence_reason' => 'dcdfkvndfm',
                'correction_reason' => 'vldfvsk',
            ],
        ]);
    }
}
