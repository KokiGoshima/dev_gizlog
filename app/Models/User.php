<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AttendanceController;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Attendance;
use App\Models\DailyReport;
use DB;
use Carbon;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slack_user_id',
        'email',
        'avatar',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function dailyReport()
    {
        return $this->hasMany(DailyReport::class, 'user_id');
    }

    public function attendance()
    {
        return $this->hasOne(Attendance::class, 'user_id')->where('date', Carbon::today()->format('Y-m-d'));
    }

    public function allAttendance()
    {
        return $this->hasMany(Attendance::class, 'user_id')->orderBy('date', 'desc');
    }

    public function createUserInstance($slackId)
    {
        return $this->withTrashed()->whereNotNull('id')->firstOrNew(['slack_user_id' => $slackId]);
    }

    public function getSlackUsers($userInfoId)
    {
        return $this->firstOrNew(['user_info_id' => $userInfoId]);
    }

    public function saveUserInfos($users, $slackUserInfos)
    {
        $users->fill([
            'name'          => $slackUserInfos->name,
            'slack_user_id' => $slackUserInfos->id,
            'email'         => $slackUserInfos->email,
            'avatar'        => $slackUserInfos->avatar,
        ])->save();
    }

    public function restoreDeletedUser($userInfoId)
    {
        DB::transaction(function() use($userInfoId) {
            $this->withTrashed()->where('user_info_id', $userInfoId)->update(['deleted_at' => null]);
        });
    }

    public function countTotalAttendanceTimes($user)
    {
        return $user->allAttendance()
                ->whereNotNull('start_time')
                ->whereNotNull('end_time')
                ->count();
    }


    public function scopeFindHasArrivedUsers($query)
    {
        return $query->leftJoin('attendances', 'users.id', '=', 'attendances.user_id')
            ->where('date', Carbon::today()->format('Y-m-d'))
            ->whereNotNull('start_time')
            ->select('users.id', 'name', 'avatar')
            ->with('attendance');
    }

    public function scopeFindHasNotArrivedUsers($query)
    {
        return $query->leftJoin('attendances', 'users.id', '=', 'attendances.user_id')
            ->where('date', '<>', Carbon::today()->format('Y-m-d'))
            ->distinct()
            ->select('users.id', 'name', 'avatar');

    }

    public function scopeFindAbsentUsers($query)
    {
        return $query->leftJoin('attendances', 'users.id', '=', 'attendances.user_id')
            ->where('date', Carbon::today()->format('Y-m-d'))
            ->where('absence_flag', 1)
            ->select('users.id', 'name', 'avatar');
    }


    public function countTotalAbsenceTime()
    {
        return $this->allAttendance()
            ->where('absence_flag', AttendanceController::IS_ABSENCE)
            ->count();
    }

    public function countTotalLateTime()
    {
        return $this->allAttendance()
            ->whereTime('start_time', '>', '10:00:00')
            ->count();
    }
}
