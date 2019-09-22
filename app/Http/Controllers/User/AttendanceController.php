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

    public function __construct(Attendance $attendance)
    {
        $this->middleware('auth');
        $this->attendance = $attendance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todayAttendance = $this->attendance->findTheDateUserAttendance(Carbon::today()->format('Y-m-d'));
        return view('user.attendance.index', compact('todayAttendance'));
    }

    public function showAbsenceForm()
    {
        return view('user.attendance.absence');
    }

    public function registerAbsence(AttendanceRequest $request)
    {
        $todayAttendance = $this->attendance->findTheDateUserAttendance($request->date);
        if(isset($todayAttendance)) {
            $todayAttendance->fill(['absence_reason' => $request->absence_reason])->save();
        }else {
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $this->attendance->fill($data)->save();
        }
        return redirect()->route('attendance.index');
    }

    public function showCorrectionForm()
    {
        return view('user.attendance.correction');
    }

    public function registerCorrection(AttendanceRequest $request)
    {
        $todayAttendance = $this->attendance->findTheDateUserAttendance($request->date);
        if(isset($todayAttendance)) {
            $todayAttendance->fill(['correction_reason' => $request->correction_reason])->save();
        }else {
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $this->attendance->fill($data)->save();
        }
        return redirect()->route('attendance.index');
    }

    public function showMypage()
    {
        $user = Auth::user();
        $allUserAttendance = $user->allAttendance;
        $allUserAttendanceCount = $this->attendance->CountAllUserAttendance($user);
        return view('user.attendance.mypage', compact('allUserAttendance', 'allUserAttendanceCount'));
    }

    public function reportArrival(Request $request)
    {
        $todayAttendance = $this->attendance->findTheDateUserAttendance(Carbon::today()->format('Y-m-d'));
        $input = $request->all();
        $input['user_id'] = Auth::id();
        if(isset($todayAttendance)) {
            $todayAttendance->fill(['start_time' => $request->start_time])->save();
        }else {
            $this->attendance->fill($input)->save();
        }
        return redirect()->route('attendance.index');
    }

    public function reportLeaving(Request $request)
    {
        $this->attendance->findTheDateUserAttendance($request->date)
            ->fill(['end_time' => $request->end_time])
            ->save();
        return redirect()->route('attendance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
