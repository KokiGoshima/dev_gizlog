<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Carbon;
use App\Models\User;

class AttendanceController extends Controller
{
    protected $attendance;
    protected $user;

    public function __construct(Attendance $attendance, User $user)
    {
        $this->attendance = $attendance;
        $this->user = $user;
    }

    public function index()
    {
        $date = Carbon::today()->format('Y-m-d');
        $user = $this->user;

        $hasArrivedUsersAttendances = $this->attendance->findHasArrivedUsersAttendances($date);
        $absentUsersAttendances = $this->attendance->findAbsentUsersAttendances($date);

        $allUserIdExceptHasNotArrivedUsers = $this->getAllUserIdExceptHasNotArrivedUsers($hasArrivedUsersAttendances, $absentUsersAttendances);
        $hasNotArrivedUsers = $this->user->findHasNotArrivedUsers($allUserIdExceptHasNotArrivedUsers);

        return view('admin.attendance.index', compact('hasArrivedUsersAttendances', 'absentUsersAttendances', 'hasNotArrivedUsers', 'user'));
    }

    private function getAllUserIdExceptHasNotArrivedUsers($hasArrivedUsersAttendances, $absentUsersAttendances)
    {
        $userId = [];
        $userId[] = $hasArrivedUsersAttendances->pluck('user_id')->all();
        $userId[] = $absentUsersAttendances->pluck('user_id')->all();
        return array_flatten($userId);
    }

    public function show($user_id)
    {
        $user = $this->user->find($user_id);
        $countAbsence = $user->allAttendance()
            ->where('absence_presence', 1)
            ->count();
        $countLate = $user->allAttendance()
            ->whereTime('start_time', '>', '10:00:00')
            ->count();
        $theDayUserCreated = $user->created_at->format('Y/m/d');
        return view('admin.attendance.user', compact('user', 'countAbsence', 'countLate', 'theDayUserCreated'));
    }
}
