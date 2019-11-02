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
     * @var Attendance $attendance 空のインズタンスが格納されます。
     */
    protected $attendance;
    protected $user;

    /**
     * 欠席である
     * @var int
     */
    const IS_ABSENCE = 1;
    const IS_NOT_ABSENCE = 0;

    /**
     * 1ページに何件取得するかの値です。
     */
    const PER_PAGE = 10;

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
        // Todo
        $users = $this->user->with('attendance')->get();
        list($arrivedUsers, $notArrivedUsers) = $users->partition(function ($user) {
            return !is_null($user->attendance);
        });
        list($absentUsers, $notAbdentUsers) = $arrivedUsers->partition(function ($user) {
            return $user->attendance->absence_flag === true;
        });

        $numOfAllUser = $notAbdentUsers->count() + $notArrivedUsers->count() + $absentUsers->count();
        return view('admin.attendance.index', compact('notAbdentUsers', 'absentUsers', 'notArrivedUsers', 'numOfAllUser'));
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
        $attendances = $user->allAttendance()->paginate(self::PER_PAGE);
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
        $attendance = $this->attendance->find($attendanceId);
        $attendance->user_id = $userId;
        $attendance->absence_flag = self::IS_NOT_ABSENCE;
        $attendance->start_time = $this->makeTimeStamp($request->date, $request->start_time);
        $attendance->end_time = $this->makeTimeStamp($request->date, $request->end_time);
        $attendance->save();
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
        $attendance = $this->attendance->find($attendanceId);
        $attendance->user_id = $userId;
        $attendance->date = $request->date;
        $attendance->absence_flag = self::IS_ABSENCE;
        $attendance->save();
        return redirect()->route('admin.attendance.showUserPage', ['user_id' => $userId]);
    }

    private function makeTimeStamp($date, $time)
    {
        return $date. ' '. $time. ':00';
    }
}
