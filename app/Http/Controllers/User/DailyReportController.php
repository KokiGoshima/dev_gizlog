<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\DailyReport;
use Carbon\Carbon;
use Auth;

class DailyReportController extends Controller
{

    private $dailyReport;

    public function __construct(DailyReport $dailyReportClass)
    {
        $this->middleware("auth");
        $this->dailyReport = $dailyReportClass;
    }

    public function index()
    {
        $reports = $this->dailyReport
        ->orderBy('reporting_time', 'desc')
        ->get();
        return view("user.daily_report.index", compact('reports'));
    }

    public function create()
    {
        return view("user.daily_report.create");
    }

    public function store(DailyReportRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->dailyReport->fill($input)->save();
        return redirect()->route('dailyReport.index');
    }

    public function show($id)
    {
        $report = $this->dailyReport->find($id);
        $dt = new Carbon($report->reporting_time);
        $day = $dt->format('D');
        return view("user.daily_report.show", compact('report', 'day'));
    }

    public function edit($id)
    {
        $report = $this->dailyReport->find($id);
        return view("user.daily_report.edit", compact('report'));
    }

    public function update(DailyReportRequest $request, $id)
    {
        $input = $request->all();
        $report = $this->dailyReport->find($id);
        $report->fill($input)->save();
        return redirect()->route('dailyReport.index');
    }

    public function delete($id)
    {
        $report = $this->dailyReport->find($id);
        $report->deleted_at = Carbon::now();
        $report->save();
        return redirect()->route('dailyReport.index');
    }

    public function search(Request $request)
    {
        $searchedMonth = $request->month;
        $reports = $this->dailyReport
        ->where('reporting_time', 'LIKE', "%{$searchedMonth}%")
        ->orderBy('reporting_time', 'desc')
        ->get();
        return view("user.daily_report.index", compact('reports'));
    }
}
