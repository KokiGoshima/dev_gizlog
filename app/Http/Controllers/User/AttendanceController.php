<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Auth;
use Illuminate\Support\Carbon;
use App\Http\Requests\User\AttendanceRequest;

class AttendanceController extends Controller
{
    protected $attendance;
    const IS_ABSENCE = 1;
    const IS_CORRECTION = 1;

    public function __construct(Attendance $attendance)
    {
        $this->middleware('auth');
        $this->attendance = $attendance;
    }

    /**
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todayAttendance = Auth::user()->attendance;
        return view('user.attendance.index', compact('todayAttendance'));
    }

    /**
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function showAbsenceForm()
    {
        return view('user.attendance.absence');
    }

    /**
     * @param AttendanceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @see Attendance::insertInputsInfo
     */
    public function storeAbsence(AttendanceRequest $request)
    {
        $inputs = $request->all();
        $inputs['absence_flag'] = self::IS_ABSENCE;
        $this->attendance->insertInputsInfo($inputs, Carbon::today()->format('Y-m-d'));
        return redirect()->route('attendance.index');
    }

    /**
     * @param void
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showCorrectionForm()
    {
        return view('user.attendance.correction');
    }

    /**
     * @param AttendanceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @see Attendance::insertInputsInfo
     */
    public function storeCorrection(AttendanceRequest $request)
    {
        $inputs = $request->all();
        $inputs['correction_flag'] = self::IS_CORRECTION;
        $this->attendance->insertInputsInfo($inputs, $request->date);
        return redirect()->route('attendance.index');
    }

    /**
     * @param void
     * @return \Illuminate\Http\Response
     * @see User::countTotalAttendanceTimes
     */
    public function showMypage()
    {
        $user = Auth::user();
        $allAttendances = $user->allAttendance;
        $numOfAllAttendances = $user->countTotalAttendanceTimes($user);
        $TotalLearningHours = $this->calculateTotalLearningHours($allAttendances);
        return view('user.attendance.mypage', compact('allAttendances', 'numOfAllAttendances', 'TotalLearningHours', 'IS_ABSENCE'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @see Attendance::insertInputsInfo
     */
    public function Arrive(Request $request)
    {
        $inputs = $request->all();
        $this->attendance->insertInputsInfo($inputs, Carbon::today()->format('Y-m-d'));
        return redirect()->route('attendance.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Leave(Request $request)
    {
        $todayAttendance = Auth::user()->attendance;
        $todayAttendance->update(['end_time' => $request->end_time]);
        return redirect()->route('attendance.index');
    }

    /**
     * @param collection $allAttendance
     * @return integer $TotalLearningHours
     */
    private function calculateTotalLearningHours($allAttendances)
    {
        $totalLearningMinutes = 0;
        $hour = 60;
        foreach ($allAttendances as $attendance) {
            if (isset($attendance->start_time) && isset($attendance->end_time)) {
                $totalLearningMinutes += $attendance->start_time->diffInMinutes($attendance->end_time);
            }
        }
        $totalLearningHours = round($totalLearningMinutes / $hour);
        return $totalLearningHours;
    }

}
