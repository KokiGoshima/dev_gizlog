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

    /**
     * @param void
     * @return \Illuminate\Http\Response
     * @see User::findHasArrivedUsers
     * @see User::findAbsentUsers
     * @see User::findHasNotArrivedUsers
     */
    public function index()
    {
        $date = Carbon::today()->format('Y-m-d');
        $user = $this->user;

        $hasArrivedUsers = $this->user->findHasArrivedUsers()->get();
        $absentUsers = $this->user->findAbsentUsers()->get();
        $hasNotArrivedUsers = $this->user->findHasNotArrivedUsers()->get();
        return view('admin.attendance.index', compact('hasArrivedUsers', 'absentUsers', 'hasNotArrivedUsers', 'user'));
    }

    /**
     * @param integer $userId
     * @return \Illuminate\Http\Response
     * @see User::countAbsence
     * @see User::countLate
     */
    public function showUserPage($userId)
    {
        $user = $this->user->find($userId);
        $numOfAbsence = $user->countAbsence();
        $numOfLate = $user->countLate();
        $theDayUserCreated = $user->created_at->format('Y/m/d');
        return view('admin.attendance.user', compact('user', 'numOfAbsence', 'numOfLate', 'theDayUserCreated'));
    }

    /**
     * @param integer $userId
     * @return \Illuminate\Http\Response
     */
    public function create($userId)
    {
        $user = $this->user->find($userId);
        return view('admin.attendance.create', compact('user'));
    }

    /**
     * @param AttendanceRequest $request
     * @param integer $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AttendanceRequest $request, $userId)
    {
        $inputs = $request->all();
        $inputs['user_id'] = $userId;
        $inputs['start_time'] = $request->date. ' '. $request->start_time. ':00';
        $inputs['end_time'] = $request->date. ' '. $request->end_time. ':00';
        $this->attendance->fill($inputs)->save();
        return redirect()->route('admin.attendance.showUserPage', ['user_id' => $userId]);
    }

    /**
     * @param AbsentRequest $request
     * @param integer $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAbsence(AbsentRequest $request, $userId)
    {
        $inputs = $request->all();
        $inputs['user_id'] = $userId;
        $inputs['absence_flag'] = 1;
        $this->attendance->fill($inputs)->save();
        return redirect()->route('admin.attendance.showUserPage', ['user_id' => $userId]);
    }

    /**
     * @param integer $userId
     * @param integer $attendanceId
     * @return \Illuminate\Http\Response
     */
    public function edit($userId, $attendanceId)
    {
        $user = $this->user->find($userId);
        $attendance = $this->attendance->find($attendanceId);
        return view('admin.attendance.edit', compact('user', 'attendance'));
    }

    /**
     * @param AttendanceUpdateRequest $request
     * @param integer $userId
     * @param integer $attendanceId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AttendanceUpdateRequest $request, $userId, $attendanceId)
    {
        $inputs = $request->all();
        $inputs['user_id'] = $userId;
        $inputs['absence_flag'] = 0;
        $inputs['start_time'] = $request->date. ' '. $request->start_time. ':00';
        $inputs['end_time'] = $request->date. ' '. $request->end_time. ':00';
        $this->attendance->find($attendanceId)->fill($inputs)->save();
        return redirect()->route('admin.attendance.showUserPage', ['user_id' => $userId]);
    }

    /**
     * @param Request $request
     * @param integer $userId
     * @param integer $attendanceId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAbsence(Request $request, $userId, $attendanceId)
    {
        $inputs = $request->all();
        $inputs['user_id'] = $userId;
        $inputs['absence_flag'] = 1;
        $inputs['start_time'] = null;
        $inputs['end_time'] = null;
        $this->attendance->find($attendanceId)->fill($inputs)->save();
        return redirect()->route('admin.attendance.showUserPage', ['user_id' => $userId]);
    }
}
