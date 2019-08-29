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

    /**
    *データーベースに格納されている全件を表表示
    *もしメソッドの引数にパラメーターが来ていたら、検索している月に該当する日報のみを表示。
    *@param Request $request --検索する月の値がmonthをキーとしてRequestインスタンスに格納される。
    */
    public function index(Request $request)
    {
        if ($request->month){
            $searchedMonth = $request->month;
            $reports = $this->dailyReport->getAllUserReportsBySearchedMonth(Auth::id(), $searchedMonth);
        }else {
            $reports = $this->dailyReport->getAllUserReports(Auth::id());
        }

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
        return view("user.daily_report.show", compact('report'));
    }

    public function edit($id)
    {
        $report = $this->dailyReport->find($id);
        return view("user.daily_report.edit", compact('report'));
    }

    public function update(DailyReportRequest $request, $id)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $report = $this->dailyReport->find($id);
        $report->fill($input)->save();
        return redirect()->route('dailyReport.index');
    }

    public function destroy($id)
    {
        $this->dailyReport->find($id)->delete();
        return redirect()->route('dailyReport.index');
    }

}
