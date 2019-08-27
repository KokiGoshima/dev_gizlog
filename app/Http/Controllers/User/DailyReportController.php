<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

	public function store(Request $request){
		// dd($request->title);
	}
}
