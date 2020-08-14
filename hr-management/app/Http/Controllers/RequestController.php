<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function logsTimesheets(){
        return view('timesheets.log_timesheets');
    }

    public function checkRequest(){
        return view('timesheets.check_request_staff');
    }
}
