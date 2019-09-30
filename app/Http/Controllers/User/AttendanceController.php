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
    protected $today;

    public function __construct(Attendance $attendance)
    {
        $this->middleware('auth');
        $this->attendance = $attendance;
        $this->today = Carbon::today()->format('Y-m-d');
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
        $todayAttendance = Auth::user()->attendance;;
        $data = $request->all();
        $data['absence_presence'] = 1;
        $data['start_time'] = null;
        $data['end_time'] = null;
        if (isset($todayAttendance)) {
            $todayAttendance->fill($data)->save();
        } else {
            $data['date'] = $this->today;
            $data['user_id'] = Auth::id();
            $this->attendance->fill($data)->save();
        }
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
        $data = $request->all();
        $data['correction_presence'] = 1;
        $todayAttendance = Auth::user()->attendance;;
        if (isset($todayAttendance)) {
            $todayAttendance->fill($data)->save();
        } else {
            $data['user_id'] = Auth::id();
            $this->attendance->fill($data)->save();
        }
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
        return view('user.attendance.mypage', compact('allAttendance', 'numOfAllAttendance', 'TotalLearningHours'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reportArrival(Request $request)
    {
        $todayAttendance = Auth::user()->attendance;
        if (isset($todayAttendance)) {
            $todayAttendance->fill(['start_time' => $request->start_time])->save();
        } else {
            $input = $request->all();
            $input['user_id'] = Auth::id();
            $this->attendance->fill($input)->save();
        }
        return redirect()->route('attendance.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reportLeaving(Request $request)
    {
        $todayAttendance = Auth::user()->attendance;
        $todayAttendance->fill(['end_time' => $request->end_time])->save();
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
