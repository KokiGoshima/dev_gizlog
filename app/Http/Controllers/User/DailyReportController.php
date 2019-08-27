<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;

class DailyReportController extends Controller
{
	public function __construct(){
		$this->middleware("auth");
	}

	public function index(){
		return view("user.daily_report.index");
	}

	public function create(){
		return view("user.daily_report.create");
	}

	public function store(DailyReportRequest $request){
		dd($request->title);
	}
}
