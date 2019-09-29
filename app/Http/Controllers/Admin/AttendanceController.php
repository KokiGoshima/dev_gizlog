<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Http\Requests\Admin\AttendanceRequest;
use App\Http\Requests\Admin\AbsentRequest;
use App\Http\Requests\Admin\AttendanceUpdateRequest;

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

        $hasArrivedUsers = $this->user->findHasArrivedUsers()->get();
        $absentUsers = $this->user->findAbsentUsers()->get();
        $hasNotArrivedUsers = $this->user->findHasNotArrivedUsers()->get();
        return view('admin.attendance.index', compact('hasArrivedUsers', 'absentUsers', 'hasNotArrivedUsers', 'user'));
    }

    public function showUserPage($userId)
    {
        $user = $this->user->find($userId);
        $numOfAbsence = $user->countAbsence();
        $numOfLate = $user->countLate();
        $theDayUserCreated = $user->created_at->format('Y/m/d');
        return view('admin.attendance.user', compact('user', 'numOfAbsence', 'numOfLate', 'theDayUserCreated'));
    }

    public function create($userId)
    {
        $user = $this->user->find($userId);
        return view('admin.attendance.create', compact('user'));
    }

    public function store(AttendanceRequest $request, $userId)
    {
        $inputs = $request->all();
        $inputs['user_id'] = $userId;
        $inputs['start_time'] = $request->date. ' '. $request->start_time. ':00';
        $inputs['end_time'] = $request->date. ' '. $request->end_time. ':00';
        $this->attendance->fill($inputs)->save();
        return redirect()->route('admin.attendance.showUserPage', ['user_id' => $userId]);
    }

    public function storeAbsence(AbsentRequest $request, $userId)
    {
        $inputs = $request->all();
        $inputs['user_id'] = $userId;
        $inputs['absence_presence'] = 1;
        $this->attendance->fill($inputs)->save();
        return redirect()->route('admin.attendance.showUserPage', ['user_id' => $userId]);
    }

    public function edit($userId, $attendance_id)
    {
        $user = $this->user->find($userId);
        $attendance = $this->attendance->find($attendance_id);
        return view('admin.attendance.edit', compact('user', 'attendance'));
    }

    public function update(AttendanceUpdateRequest $request, $userId, $attendance_id)
    {
        $inputs = $request->all();
        $inputs['user_id'] = $userId;
        $inputs['absence_presence'] = 0;
        $inputs['start_time'] = $request->date. ' '. $request->start_time. ':00';
        $inputs['end_time'] = $request->date. ' '. $request->end_time. ':00';
        $this->attendance->find($attendance_id)->fill($inputs)->save();
        return redirect()->route('admin.attendance.showUserPage', ['user_id' => $userId]);
    }

    public function updateAbsence(Request $request, $userId, $attendance_id)
    {
        $inputs = $request->all();
        $inputs['user_id'] = $userId;
        $inputs['absence_presence'] = 1;
        $inputs['start_time'] = null;
        $inputs['end_time'] = null;
        $this->attendance->find($attendance_id)->fill($inputs)->save();
        return redirect()->route('admin.attendance.showUserPage', ['user_id' => $userId]);
    }
}
