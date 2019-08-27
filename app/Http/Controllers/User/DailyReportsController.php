<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyReportsController extends Controller
{
	public function __construct(){
		$this->middleware("auth");
	}

	public function index(){
		return view("user.daily_report.index");
	}
}
