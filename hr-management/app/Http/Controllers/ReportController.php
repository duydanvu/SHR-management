<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function showReportTime(){
        return view('report.report_with_time');
    }

    public function showDetailTime(){
        return view('report.report_staff_detail');
    }


}
