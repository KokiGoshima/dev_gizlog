<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    protected $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function index()
    {
        $date = Carbon::today()->format('Y-m-d');

        $hasArrivedUsersAttendances = $this->attendance->findHasArrivedUsersAttendances($date);
        $absentUsersAttendances = $this->attendance->findAbsentUsersAttendances($date);

        $allUserIdExceptHasNotArrivedUsers = $this->getAllUserIdExceptHasNotArrivedUsers($hasArrivedUsersAttendances, $absentUsersAttendances);
        $hasNotArrivedUsersAttendances = $this->attendance->findHasNotArrivedUsersAttendances();

        return view('admin.attendance.index', compact('hasArrivedUsersAttendances', 'hasNotArrivedUsersAttendances', 'absentUsersAttendances'));
    }

    private function getAllUserIdExceptHasNotArrivedUsers($hasArrivedUsersAttendances, $absentUsersAttendances)
    {
        $userId = [];
        $userId[] = $hasArrivedUsersAttendances->pluck('user_id')->all();
        $userId[] = $absentUsersAttendances->pluck('user_id')->all();
        return array_flatten($userId);
    }
}
