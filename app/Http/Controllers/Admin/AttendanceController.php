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
    /**
    * 空のインズタンスが格納されます。
    */
    protected $attendance;
    protected $user;

    /**
    * attendancesテーブルのabsence_flagカラムに入れるための値です。
    */
    const IS_ABSENCE = 1;
    const IS_NOT_ABSENCE = 0;

    public function __construct(Attendance $attendance, User $user)
    {
        $this->middleware('auth:admin');
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
        $numOfAllUser = $this->user->count();

        $hasArrivedUsers = $this->user->findHasArrivedUsers()->get();
        $hasNotArrivedUsers = $this->user->findHasNotArrivedUsers()->get();
        $absentUsers = $this->user->findAbsentUsers()->get();
        return view('admin.attendance.index', compact('hasArrivedUsers', 'absentUsers', 'hasNotArrivedUsers', 'numOfAllUser'));
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
        $attendances = $user->allAttendance()->paginate(10);
        return view('admin.attendance.user', compact('user', 'attendances'));
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
        $inputs['start_time'] = $this->makeTimeStamp($request->date, $request->start_time);
        $inputs['end_time'] = $this->makeTimeStamp($request->date, $request->start_time);
        $this->attendance->fill($inputs)->save();
        return redirect()->route('admin.attendance.showUserPage', ['user_id' => $userId]);
    }

    /**
     * @param AbsentRequest $request
     * @param integer $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAbsence(AttendanceRequest $request, $userId)
    {
        $inputs = $request->all();
        $inputs['user_id'] = $userId;
        $inputs['absence_flag'] = self::IS_ABSENCE;
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
    public function updateAttendance(AttendanceRequest $request, $userId, $attendanceId)
    {
        $inputs = $request->all();
        $inputs['user_id'] = $userId;
        $inputs['absence_flag'] = self::IS_NOT_ABSENCE;
        $inputs['start_time'] = $this->makeTimeStamp($request->date, $request->start_time);
        $inputs['end_time'] = $this->makeTimeStamp($request->date, $request->end_time);
        $this->attendance->find($attendanceId)->update($inputs);
        return redirect()->route('admin.attendance.showUserPage', ['user_id' => $userId]);
    }

    /**
     * @param Request $request
     * @param integer $userId
     * @param integer $attendanceId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateToAbsence(AttendanceRequest $request, $userId, $attendanceId)
    {
        $inputs = $request->all();
        $inputs['user_id'] = $userId;
        $inputs['absence_flag'] = self::IS_ABSENCE;
        $inputs['start_time'] = null;
        $inputs['end_time'] = null;
        $this->attendance->find($attendanceId)->update($inputs);
        return redirect()->route('admin.attendance.showUserPage', ['user_id' => $userId]);
    }

    private function makeTimeStamp($date, $time)
    {
        return $date. ' '. $time. ':00';
    }
}
