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
     * Display a listing of the resource.
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
     */
    public function registerAbsence(AttendanceRequest $request)
    {
        $inputs = $request->all();
        $inputs['absence_flag'] = self::IS_ABSENCE;
        $inputs['start_time'] = null;
        $inputs['end_time'] = null;
        $this->attendance->updateOrCreate(
            ['user_id' => Auth::id(), 'date' => Carbon::today()->format('Y-m-d')],
            $inputs
        );
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
     */
    public function registerCorrection(AttendanceRequest $request)
    {
        $inputs = $request->all();
        $inputs['correction_flag'] = self::IS_CORRECTION;
        $this->attendance->updateOrCreate(
            ['user_id' => Auth::id(), 'date' => $request->date],
            $inputs
        );
        return redirect()->route('attendance.index');
    }

    /**
     * @param void
     * @return \Illuminate\Http\Response
     * @see Attendance::countAllAttendance
     */
    public function showMypage()
    {
        $user = Auth::user();
        $allAttendance = $user->allAttendance;
        $numOfAllAttendance = $this->attendance->countAllAttendance($user);
        $TotalLearningHours = $this->calculateTotalLearningHours($allAttendance);
        return view('user.attendance.mypage', compact('allAttendance', 'numOfAllAttendance', 'TotalLearningHours', 'IS_ABSENCE'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reportArrival(Request $request)
    {
        $inputs = $request->all();
        $this->attendance->insertStartTime($inputs);
        return redirect()->route('attendance.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reportLeaving(Request $request)
    {
        $inputs = $request->all();
        $todayAttendance = Auth::user()->attendance;
        $todayAttendance->fill($inputs)->save();
        return redirect()->route('attendance.index');
    }

    /**
     * @param collection $allAttendance
     * @return integer $TotalLearningHours
     */
    public function calculateTotalLearningHours($allAttendance)
    {
        $TotalLearningMinutes = 0;
        foreach ($allAttendance as $attendance) {
            if (isset($attendance->start_time) && isset($attendance->end_time)) {
                $dt1 = $attendance->start_time;
                $dt2 = $attendance->end_time;
                $TotalLearningMinutes += $dt1->diffInMinutes($dt2);
            }
        }
        $TotalLearningHours = round($TotalLearningMinutes / 60, 0);
        return $TotalLearningHours;
    }

}
