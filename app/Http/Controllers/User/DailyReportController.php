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

	private $daily_report;

	public function __construct(DailyReport $instanceClass){
		$this->middleware("auth");
		$this->daily_report = $instanceClass;
	}

	public function index(){
		$reports = $this->daily_report
		->where('deleted_at', null)
		->orderBy('created_at', 'desc')
		->get();
		return view("user.daily_report.index", compact('reports'));
	}

	public function create(){
		return view("user.daily_report.create");
	}

	public function store(DailyReportRequest $request){
		$input = $request->all();
		$input['user_id'] = Auth::id();
		$this->daily_report->fill($input)->save();
		return redirect()->route('daily_report.index');
	}

	public function show($id){
		$report = $this->daily_report->find($id);
		$dt = new Carbon($report->reporting_time);
		$day = $dt->format('D');
		return view("user.daily_report.show", compact('report', 'day'));
	}

	public function edit($id){
		$report = $this->daily_report->find($id);
		return view("user.daily_report.edit", compact('report'));
	}

	public function update(DailyReportRequest $request, $id){
		$input = $request->all();
		$report = $this->daily_report->find($id);
		$report->fill($input)->save();
		return redirect()->route('daily_report.index');
	}

	public function delete($id){
		$report = $this->daily_report->find($id);
		$report->deleted_at = Carbon::now();
		$report->save();
		return redirect()->route('daily_report.index');
	}

	public function search(Request $request){
		$searchedMonth = $request->month;
		$reports = $this->daily_report
		->where('reporting_time', 'LIKE', "%{$searchedMonth}%")
		->orderBy('created_at', 'desc')
		->get();
		return view("user.daily_report.index", compact('reports'));
	}
}
