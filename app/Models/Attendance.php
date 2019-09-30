<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Illuminate\Support\Carbon;

class Attendance extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time',
        'absence_reason',
        'correction_reason',
        'absence_flag',
        'correction_flag',
    ];

    protected $dates = [
        'deleted_at',
        'date',
        'start_time',
        'end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function countAllAttendance($user)
    {
        return $user->allAttendance()
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->count();
    }

    public function findTheDayUserAttendance($date, $userId)
    {
        $result = $this->where('date', $date)
            ->where('user_id', $userId)
            ->get();
        if ($result->isNotEmpty()) {
            return $result;
        } else {
            return  false;
        }
    }

    public function insertStartTime($inputs)
    {
        return $this->updateOrCreate(
            ['user_id' => Auth::id(), 'date' => Carbon::today()->format('Y-m-d')],
            $inputs
        );
    }

}
