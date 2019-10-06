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

    protected $casts = [
        'absence_flag' => 'boolean',
        'correction_flag' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function findTheDayUserAttendance($date, $userId)
    {
        return $result = $this->where('date', $date)
            ->where('user_id', $userId)
            ->get();
    }

    public function insertInputsInfo($inputs, $date)
    {
        return $this->updateOrCreate(
            ['user_id' => Auth::id(), 'date' => $date],
            $inputs
        );
    }

}
