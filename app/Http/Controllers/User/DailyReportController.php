<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\DailyReport;
use Auth;

class DailyReportController extends Controller
{

	private $daily_report;

	public function __construct(DailyReport $instanceClass){
		$this->middleware("auth");
		$this->daily_report = $instanceClass;
	}

	public function index(){
		return view("user.daily_report.index");
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
}
