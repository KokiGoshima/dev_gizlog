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
        $allUserIdExceptHasNotArrivedUsers = [];

        $hasArrivedUsersAttendances = $this->attendance->findHasArrivedUsersAttendances($date);
        $absentUsersAttendances = $this->attendance->findAbsentUsersAttendances($date);
        $hasNotArrivedUsersAttendances = $this->attendance->findHasNotArrivedUsersAttendances();

        $allUserIdExceptHasNotArrivedUsers = $this->pluckAllUserIdExceptHasNotArrivedUsers($hasArrivedUsersAttendances, $absentUsersAttendances);
        dd($allUserIdExceptHasNotArrivedUsers);

        return view('admin.attendance.index', compact('hasArrivedUsersAttendances', 'hasNotArrivedUsersAttendances', 'absentUsersAttendances'));
    }

    private function pluckAllUserIdExceptHasNotArrivedUsers($hasArrivedUsersAttendances, $absentUsersAttendances)
    {
        $allUserIdExceptHasNotArrivedUsers = [];
        $plucked = $hasArrivedUsersAttendances->pluck('user_id')->all();
        foreach ($plucked as $userId) {
            $allUserIdExceptHasNotArrivedUsers[] = $userId;
        }
        $plucked = $absentUsersAttendances->pluck('user_id')->all();
        foreach ($plucked as $userId) {
            $allUserIdExceptHasNotArrivedUsers[] = $userId;
        }
        return $allUserIdExceptHasNotArrivedUsers;
    }
}
