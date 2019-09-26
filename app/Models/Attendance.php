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
        'absence_presence',
        'correction_presence',
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

    // User側で用いるメソッド

    public function findTheDateUserAttendance($date, $user_id)
    {
        return $this->where('date', $date)
            ->where('user_id', $user_id)
            ->first();
    }

    public function CountAllUserAttendance($user)
    {
        return $user->allAttendance()
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->count();
    }

    // Admin側で用いるメソッド

    public function findHasArrivedUsersAttendances($date)
    {
        return $this->where('date', $date)
            ->whereNotNull('start_time')
            ->orderBy('start_time', 'asc')
            ->with('user')
            ->get();
    }


    public function findAbsentUsersAttendances($date)
    {
        return $this->where('date', $date)
            ->where('absence_presence', 1)
            ->with('user')
            ->get();
    }

}
