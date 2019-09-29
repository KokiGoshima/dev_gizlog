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

    /**
     * @param UserInstance $user
     * @return integer
     */
    public function CountAllAttendance($user)
    {
        return $user->allAttendance()
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->count();
    }

}
