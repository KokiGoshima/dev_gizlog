<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\DailyReport;
use Illuminate\Support\Str;
use Auth;

class DailyReportController extends Controller
{

    private $dailyReport;

    /**
    * @param DailyReportInstance $dailyReportClass
    * @return void
    */
    public function __construct(DailyReport $dailyReportClass)
    {
        $this->middleware("auth");
        $this->dailyReport = $dailyReportClass;
    }

    /**
    * @param RequestInstance $request
    * @param StrInstance $strClass
    * @return ViewInstance
    * @see DailyReport::getAllReport
    * @see DailyReport::getReportByMonth
    */
    public function index(Request $request, Str $strClass)
    {
        $str = $strClass;

        if ($request->month){
            $searchedMonth = $request->month;
            $reports = $this->dailyReport->getReportByMonth(Auth::id(), $searchedMonth);
        }else {
            $reports = $this->dailyReport->getAllReport(Auth::id());
        }

        return view("user.daily_report.index", compact('reports', 'str'));
    }

    /**
    * @param void
    * @return ViewInstance
    */
    public function create()
    {
        return view("user.daily_report.create");
    }

    /**
    * @param DailyReportRequest $request
    * @return RedirectResponse
    */
    public function store(DailyReportRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->dailyReport->fill($input)->save();
        return redirect()->route('dailyReport.index');
    }

    /**
    * @param integer $id
    * @return ViewInstance
    */
    public function show($id)
    {
        $report = $this->dailyReport->find($id);
        return view("user.daily_report.show", compact('report'));
    }

    /**
    * @param integer $id
    * @return ViewInstance
    */
    public function edit($id)
    {
        $report = $this->dailyReport->find($id);
        return view("user.daily_report.edit", compact('report'));
    }

    /**
    * @param DailyReportRequest $request
    * @param integer $id
    * @return RedirectResponse
    */
    public function update(DailyReportRequest $request, $id)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->dailyReport
            ->find($id)
            ->fill($input)
            ->save();
        return redirect()->route('dailyReport.index');
    }

    /**
    * @param integer $id
    * @return RedirectResponse
    */
    public function destroy($id)
    {
        $this->dailyReport->find($id)->delete();
        return redirect()->route('dailyReport.index');
    }

}
