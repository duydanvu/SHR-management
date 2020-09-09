<?php

namespace App\Http\Controllers;

use App\Area;
use App\Contract;
use App\Department;
use App\Position;
use App\Services;
use App\Store;
use App\Timesheet;
use App\User;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Type\Time;

class RequestController extends Controller
{
    public function logsTimesheets(){
        $user_id = Auth::id();
        $roles = User::find($user_id);
        $date = date("Y-m-d");
        $timesheet = Timesheet::where('date','=',$date)->select('user_id')->get();
        if($roles->position_id == 1){
//            $staff = DB::table('users')->join('timesheets','timesheets.user_id','=','users.id')
//                ->where('position_id','=',2)
//                ->select('users.*','timesheets.id as id_timesheet','timesheets.date as date_timesheet')
//                ->get();
            $staff = User::all()->where('position_id','=',2);
            if(count($timesheet) > 0) {
                foreach ($timesheet as $value) {
                    $staff = $staff->where('id', '!=', $value->user_id);
                }
            }
        }elseif ($roles->position_id == 2){
            $staff = User::all()->where('position_id','=',3)
                                ->where('store_id','=',$roles->store_id);
            if(count($timesheet) > 0) {
                foreach ($timesheet as $value) {
                    $staff = $staff->where('id', '!=', $value->user_id);
                }
            }
        }
        return view('timesheets.log_timesheets')->with(['staff'=>$staff,'roles'=>$roles]);
    }

    public function viewReportTimesheet(){
        $area = Area::all();
        $store = Store::all();
        $position = Position::all();
        $department = Department::all();
        $service = Services::all();
        $contract = Contract::all();
        $auth = Auth::user();
        $user1 = User::join('stores','users.store_id','=','stores.store_id')
            ->join('positions','users.position_id','=','positions.position_id')
            ->join('contracts','users.contract_id','=','contracts.contract_id')
            ->join('departments','users.department_id','=','departments.id')
            ->join('services','users.service_id','=','services.id')
            ->join('timesheets','users.id','=','timesheets.user_id')
            ->select(DB::raw('DISTINCT users.id as id'),'users.first_name','users.last_name','users.email','stores.store_name',
                'positions.position_name','contracts.name as ct_name'
                ,'departments.name as dp_name','services.name as sv_name')
            -> addSelect(DB::raw("'0' as present"))
            -> addSelect(DB::raw("'0' as absent_yes"))
            -> addSelect(DB::raw("'0' as absent_no"));
        if($auth->position_id == 1){
            $user = $user1->where('users.position_id','=','2')->get();
        }elseif ($auth->position_id == 2){
            $user = $user1->where('users.store_id','=',$auth->store_id)->get();
        };
        $user_present = Timesheet::where('logtime','=','present')
                        ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as present'))
                        ->groupBy('logtime','user_id')
                        ->get();
        $user_absent_yes = Timesheet::where('logtime','=','absent')
            ->where('comment','<>',null)
            ->where('status','=','done')
            ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_yes'))
            ->groupBy('logtime','user_id')
            ->get();
        $user_absent_no = Timesheet::where('logtime','=','absent')
            ->where('comment','=',null)
            ->where('status','=','done')
            ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_no'))
            ->groupBy('logtime','user_id')
            ->get();
        foreach ($user as $value_user){
            foreach ($user_present as $value_present){
                if($value_present->user_id === $value_user->id){
                    $value_user->present = $value_present->present;
                }
            }
        }
        foreach ($user as $value_user){
            foreach ($user_absent_yes as $value_ab_yes){
                if($value_ab_yes->user_id === $value_user->id){
                    $value_user->absent_yes = $value_ab_yes->absent_yes;
                }
            }
        }
        foreach ($user as $value_user){
            foreach ($user_absent_no as $value_ab_no){
                if($value_ab_no->user_id === $value_user->id){
                    $value_user->absent_no = $value_ab_no->absent_no;
                }
            }
        }
        return view('timesheets.view_report_request')->with([
            'area'=>$area,
            'store'=>$store,
            'position'=> $position,
            'position_auth'=>$auth->position_id,
            'department' => $department,
            'service'=>$service,
            'contract'=>$contract,
            'user'=>$user]);
    }

    public function searchTimesheet(Request $request){
        $result = null;
        $auth = Auth::user();
//        dd($auth->position_id);
        if ($auth->position_id == 1){
            $user = User::join('stores','users.store_id','=','stores.store_id')
                ->join('positions','users.position_id','=','positions.position_id')
                ->join('contracts','users.contract_id','=','contracts.contract_id')
                ->join('departments','users.department_id','=','departments.id')
                ->join('services','users.service_id','=','services.id')
                ->join('timesheets','users.id','=','timesheets.user_id')
                ->select(DB::raw('DISTINCT users.id as id'),'users.first_name','users.last_name'
                    ,'users.email','stores.store_name',
                    'positions.position_name','contracts.name as ct_name'
                    ,'departments.name as dp_name','services.name as sv_name')
                ->where('users.position_id','=','2')
                -> addSelect(DB::raw("'0' as present"))
                -> addSelect(DB::raw("'0' as absent_yes"))
                -> addSelect(DB::raw("'0' as absent_no"));
        }elseif ($auth->position_id == 2){
            $user = User::join('stores','users.store_id','=','stores.store_id')
                ->join('positions','users.position_id','=','positions.position_id')
                ->join('contracts','users.contract_id','=','contracts.contract_id')
                ->join('departments','users.department_id','=','departments.id')
                ->join('services','users.service_id','=','services.id')
                ->join('timesheets','users.id','=','timesheets.user_id')
                ->select(DB::raw('DISTINCT users.id as id'),'users.first_name','users.last_name'
                    ,'users.email','stores.store_name',
                    'positions.position_name','contracts.name as ct_name'
                    ,'departments.name as dp_name','services.name as sv_name')
                ->where('users.store_id','=',$auth->store_id)
                -> addSelect(DB::raw("'0' as present"))
                -> addSelect(DB::raw("'0' as absent_yes"))
                -> addSelect(DB::raw("'0' as absent_no"));
        }
        if($request->area_search === 'all' || $request->area_search == null){
            $user_area = $user;
        }else{
            $user_area = $user->where('stores.area_id','=',$request->area_search);
        }

        if($request->store_search === 'all' || $request->store_search == null){
            $user_store = $user_area;
        }else{
            $user_store = $user_area->where('users.store_id','=',$request->store_search);
        }

        if($request->position_search === 'all' || $request->position_search == null){
            $user_position = $user_store;
        }else{
            $user_position = $user_store->where('users.position_id','=',$request->position_search);
        }

        if($request->contract_search === 'all' || $request->contract_search == null){
            $user_contract = $user_position;
        }else{
            $user_contract = $user_position->where('users.contract_id','=',$request->contract_search);
        }

        if($request->department_search === 'all' || $request->department_search == null){
            $user_department = $user_contract;
        }else{
            $user_department = $user_contract->where('users.department_id','=',$request->department_search);
        }
        if($request->service_search === 'all' || $request->service_search == null){
            $user_service = $user_department;
        }else{
            $user_service = $user_department->where('users.service_id','=',$request->service_search);
        }
        if($request->start_date != null && $request->end_date != null){
            if(strtotime($request->start_date) > strtotime($request->end_date)){
                $user_time = $user_service;
                $user_present = Timesheet::where('logtime','=','present')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as present'))
                    ->groupBy('logtime','user_id')
                    ->get();
                $user_absent_yes = Timesheet::where('logtime','=','absent')
                    ->where('comment','<>',null)
                    ->where('status','=','done')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_yes'))
                    ->groupBy('logtime','user_id')
                    ->get();
                $user_absent_no = Timesheet::where('logtime','=','absent')
                    ->where('comment','=',null)
                    ->where('status','=','done')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_no'))
                    ->groupBy('logtime','user_id')
                    ->get();
            } else if (strtotime($request->start_date) == strtotime($request->end_date)){
                $user_time = $user_service->where('timesheets.date','=',$request->end_date);
                $user_present = Timesheet::where('logtime','=','present')
                    ->whereBetween('date','=',$request->end_date)
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as present'))
                    ->groupBy('logtime','user_id')
                    ->get();
                $user_absent_yes = Timesheet::where('logtime','=','absent')
                    ->whereBetween('date','=',$request->end_date)
                    ->where('comment','<>',null)
                    ->where('status','=','done')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_yes'))
                    ->groupBy('logtime','user_id')
                    ->get();
                $user_absent_no = Timesheet::where('logtime','=','absent')
                    ->whereBetween('date','=',$request->end_date)
                    ->where('comment','=',null)
                    ->where('status','=','done')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_no'))
                    ->groupBy('logtime','user_id')
                    ->get();
            }else{
                $user_time = $user_service->whereBetween('timesheets.date',[$request->start_date,$request->end_date]);
                $user_present = Timesheet::where('logtime','=','present')
                    ->whereBetween('date',[$request->start_date,$request->end_date])
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as present'))
                    ->groupBy('logtime','user_id')
                    ->get();
                $user_absent_yes = Timesheet::where('logtime','=','absent')
                    ->whereBetween('date',[$request->start_date,$request->end_date])
                    ->where('comment','<>',null)
                    ->where('status','=','done')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_yes'))
                    ->groupBy('logtime','user_id')
                    ->get();
                $user_absent_no = Timesheet::where('logtime','=','absent')
                    ->whereBetween('date',[$request->start_date,$request->end_date])
                    ->where('comment','=',null)
                    ->where('status','=','done')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_no'))
                    ->groupBy('logtime','user_id')
                    ->get();
            }
        }else{
            $user_time = $user_service;
        }
        $user_rs = $user_time->get();
        foreach ($user_rs as $value_user){
            foreach ($user_present as $value_present){
                if($value_present->user_id === $value_user->id){
                    $value_user->present = $value_present->present;
                }
            }
        }
        foreach ($user_rs as $value_user){
            foreach ($user_absent_yes as $value_ab_yes){
                if($value_ab_yes->user_id === $value_user->id){
                    $value_user->absent_yes = $value_ab_yes->absent_yes;
                }
            }
        }
        foreach ($user_rs as $value_user){
            foreach ($user_absent_no as $value_ab_no){
                if($value_ab_no->user_id === $value_user->id){
                    $value_user->absent_no = $value_ab_no->absent_no;
                }
            }
        }
        foreach ($user_rs as $key=>$value){
            $result .= '<tr>';
            $result .= '<td>'.($key+1).'</td>';
            $result .= '<td>'.$value->first_name.' '.$value->last_name.'</td>';
            $result .= '<td>'.$value->email.'</td>';
            $result .= '<td>'.$value->store_name.'</td>';
            $result .= '<td>'.$value->position_name.'</td>';
            $result .= '<td>'.$value->dp_name.'</td>';
            $result .= '<td>'.$value->sv_name.'</td>';
            $result .= '<td>'.$value->present.'</td>';
            $result .= '<td>'.$value->absent_yes.'</td>';
            $result .= '<td>'.$value->absent_no.'</td>';
            $result .= '</tr>';
        }
        return $result;
    }

    public function addViewTimesheet($id){
        $user = User::find($id);
        return view('timesheets.add_time_sheet')->with(['user'=>$user]);
    }

    public function updateTimesheet($id,$date){
        $date1 = date("Y-m-d");
        if($date <10){$date = '0'.$date;}
        if(strlen($date) > 2){
            $date_search = $date;
        }else{
            $date_search = substr($date1, 0, 8).$date;
        }
        $id_time = Timesheet::where('user_id','=',$id)
                    ->where('date','=',$date_search)
                    ->select('id')->get();
        if(count($id_time)>0) {
            foreach ($id_time as $value) {
                $timesheet = Timesheet::where('id','=',$value->id)->get();
            }
        }else{
            $timesheet = collect([
                (object)[
                    "id" => null,
                    "user_id" => $id,
                    "date" => $date_search,
                    "logtime" => null,
                    "status" => null,
                    "comment" => null,
                    "start_time" => null,
                    "end_time" => null,
                    "created_at" => null,
                    "updated_at" => null
                ]
            ]);
        }
//        dd($timesheet);
        return view('timesheets.update_time_sheet')->with(['user_timesheet'=>$timesheet]);

    }

    public function updaeTimeSheetStoreManage(Request $request){
        if(strcmp($request->status_timesheet,'done') == 0 || strcmp($request->status_timesheet,'reject') == 0) {
            $data_request_update = DB::table('timesheets')->where('id', '=', $request->user_id)
                ->update([
                    'status' => $request->status_timesheet
                ]);
            if ($data_area_update = 1) {
                $notification = array(
                    'message' => 'Cập nhật thông tin thành công!',
                    'alert-type' => 'success'
                );
            } else {
                $notification = array(
                    'message' => 'Cập nhật thông tin không thành công!',
                    'alert-type' => 'error'
                );
            }
            return Redirect::back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Update time sheet chỉ có thể là Done hoặc Reject!',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
    }

    public function addTimeSheet(Request $request){
        $date = date("Y-m-d");
        $user_id = Auth::id();
        $roles = User::find($user_id);
        if($request['txtTimeStart'] > $request['txtTimeEnd']){
            $notification= array(
                'message' => 'Thời gian bị lỗi, kiểm tra thông tin thời gian!',
                'alert-type' => 'error'
            );
            return Redirect::back()
                ->with($notification)
                ->withInput();
        }
        $validator = \Validator::make($request->all(),[
            'user_id' => 'required|max:11',
            'status_timesheet' => 'required|max:8'
        ]);
        $notification= array(
            'message' => 'Thêm chấm công lỗi! Hãy chọn phần tạo tài khoản và nhập lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $add_time_sheet = DB::table('timesheets')->insert([
                'user_id'=> $request['user_id'],
                'date' => $date,
                'logtime' => $request['status_timesheet'],
                'status' => 'done',
                'comment' => $request['txtComment'],
                'start_time'=>$request['txtTimeStart'],
                'end_time' =>$request['txtTimeEnd']
            ]);
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Thêm chấm công không chính xác! Vui lòng nhập lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Thêm thông tin thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }


    public function checkRequest(){
        $user_id = Auth::id();
        $roles = User::find($user_id);
        $date = date("Y-m-d");
        $date_now = substr($date,-2,2);
        $month_now = substr($date,-5,2);
        if($roles->position_id == 1){
            $staff = DB::table('timesheets')
                ->join('users','timesheets.user_id','=','users.id')
                ->select(DB::raw('DISTINCT(users.last_name)')
                    ,DB::raw("'0' as D01")
                    ,DB::raw("'0' as D02")
                    ,DB::raw("'0' as D03")
                    ,DB::raw("'0' as D04")
                    ,DB::raw("'0' as D05")
                    ,DB::raw("'0' as D06")
                    ,DB::raw("'0' as D07")
                    ,DB::raw("'0' as D08")
                    ,DB::raw("'0' as D09")
                    ,DB::raw("'0' as D10")
                    ,DB::raw("'0' as D11")
                    ,DB::raw("'0' as D12")
                    ,DB::raw("'0' as D13")
                    ,DB::raw("'0' as D14")
                    ,DB::raw("'0' as D15")
                    ,DB::raw("'0' as D16")
                    ,DB::raw("'0' as D17")
                    ,DB::raw("'0' as D18")
                    ,DB::raw("'0' as D19")
                    ,DB::raw("'0' as D20")
                    ,DB::raw("'0' as D21")
                    ,DB::raw("'0' as D22")
                    ,DB::raw("'0' as D23")
                    ,DB::raw("'0' as D24")
                    ,DB::raw("'0' as D25")
                    ,DB::raw("'0' as D26")
                    ,DB::raw("'0' as D27")
                    ,DB::raw("'0' as D28")
                    ,DB::raw("'0' as D29")
                    ,DB::raw("'0' as D30")
                    ,DB::raw("'0' as D31")
                    ,'users.id')
                ->where('position_id','=','2')
                ->whereBetween('date',[substr($date, 0, 8).'01',substr($date, 0, 8).'31'])
                ->get();

                foreach ($staff as $values) {
                    for($i = 1; $i <=31; $i++) {
                    if($i <10){
                        $i = '0'.$i;
                    }else{
                        $i = $i;
                    }
                    $item = 'D'.$i;
                    $check_time_01 = Timesheet::all()
                        ->where('user_id', '=', $values->id)
                        ->where('date', '=', substr($date, 0, 8) . $i);
                    if (count($check_time_01) > 0) {
                        foreach ($check_time_01 as $check_time){
                            if($check_time->logtime == 'present'){
                                $values->$item = '1';
                            }else{
                                if($check_time->logtime == 'absent'){
                                    $values->$item = '2';
                                }else{
                                    $values->$item = '3';
                                }
                            }
                        }
                    }
                }
            }
        }elseif ($roles->position_id == 2){
            $staff = DB::table('timesheets')
                ->rightJoin('users','timesheets.user_id','=','users.id')
                ->select(DB::raw('DISTINCT(users.last_name)')
                    ,DB::raw("'0' as D01")
                    ,DB::raw("'0' as D02")
                    ,DB::raw("'0' as D03")
                    ,DB::raw("'0' as D04")
                    ,DB::raw("'0' as D05")
                    ,DB::raw("'0' as D06")
                    ,DB::raw("'0' as D07")
                    ,DB::raw("'0' as D08")
                    ,DB::raw("'0' as D09")
                    ,DB::raw("'0' as D10")
                    ,DB::raw("'0' as D11")
                    ,DB::raw("'0' as D12")
                    ,DB::raw("'0' as D13")
                    ,DB::raw("'0' as D14")
                    ,DB::raw("'0' as D15")
                    ,DB::raw("'0' as D16")
                    ,DB::raw("'0' as D17")
                    ,DB::raw("'0' as D18")
                    ,DB::raw("'0' as D19")
                    ,DB::raw("'0' as D20")
                    ,DB::raw("'0' as D21")
                    ,DB::raw("'0' as D22")
                    ,DB::raw("'0' as D23")
                    ,DB::raw("'0' as D24")
                    ,DB::raw("'0' as D25")
                    ,DB::raw("'0' as D26")
                    ,DB::raw("'0' as D27")
                    ,DB::raw("'0' as D28")
                    ,DB::raw("'0' as D29")
                    ,DB::raw("'0' as D30")
                    ,DB::raw("'0' as D31")
                    ,'users.id')
                ->where('position_id','<>','1')
                ->where('position_id','<>','2')
                ->where('users.store_id','=',$roles->store_id)
                ->whereBetween('date',[substr($date, 0, 8).'01',substr($date, 0, 8).'31'])
                ->get();

            foreach ($staff as $values) {
                for($i = 1; $i <=31; $i++) {
                    if($i <10){
                        $i = '0'.$i;
                    }else{
                        $i = $i;
                    }
                    $item = 'D'.$i;
                    $check_time_01 = Timesheet::all()
                        ->where('user_id', '=', $values->id)
                        ->where('date', '=', substr($date, 0, 8) . $i);
                    if (count($check_time_01) > 0) {
                        foreach ($check_time_01 as $check_time){
                            if($check_time->logtime == 'present'){
                                $values->$item = '1';
                            }else{
                                if($check_time->logtime == 'absent'){
                                    $values->$item = '2';
                                }else{
                                    $values->$item = '3';
                                }
                            }
                        }
                    }
                }
            }
        }
        if($date_now < 10){
            $date_now = substr($date_now,1,1);
        }
        $date_of_week = [];
        $day_with_week = [];

        for ($i = (int)$date_now; $i >0;$i--){
            if($i < 10){
                $date_1 = substr($date, 0, 8).'0'.$i;
                $dayOfWeek = date("l", strtotime($date_1));
                $date_of_week[substr($date_1,5,5)] = $dayOfWeek;
            }else{
                $date_1 = substr($date, 0, 8).$i;
                $dayOfWeek = date("l", strtotime($date_1));
                $date_of_week[substr($date_1,5,5)] = $dayOfWeek;
            }
        }
        return view('timesheets.check_request_staff')->with(['staff'=>$staff,'auth'=>$roles,
            'date_now'=>$date_now,'month_now'=>$month_now,'date_of_week'=>$date_of_week]);
    }
    public function checkTimesheetMonth(){
        $user_id = Auth::id();
        $roles = User::find($user_id);
        $date = date("Y-m-d");
        $month = substr($date,0,7);
        $date_now = substr($date,-2,2);
        if($roles->position_id == 1){
            $staff = DB::table('timesheets')
                ->join('users','timesheets.user_id','=','users.id')
                ->select(DB::raw('DISTINCT(users.last_name)')
                    ,DB::raw("'0' as D01")
                    ,DB::raw("'0' as D02")
                    ,DB::raw("'0' as D03")
                    ,DB::raw("'0' as D04")
                    ,DB::raw("'0' as D05")
                    ,DB::raw("'0' as D06")
                    ,DB::raw("'0' as D07")
                    ,DB::raw("'0' as D08")
                    ,DB::raw("'0' as D09")
                    ,DB::raw("'0' as D10")
                    ,DB::raw("'0' as D11")
                    ,DB::raw("'0' as D12")
                    ,DB::raw("'0' as D13")
                    ,DB::raw("'0' as D14")
                    ,DB::raw("'0' as D15")
                    ,DB::raw("'0' as D16")
                    ,DB::raw("'0' as D17")
                    ,DB::raw("'0' as D18")
                    ,DB::raw("'0' as D19")
                    ,DB::raw("'0' as D20")
                    ,DB::raw("'0' as D21")
                    ,DB::raw("'0' as D22")
                    ,DB::raw("'0' as D23")
                    ,DB::raw("'0' as D24")
                    ,DB::raw("'0' as D25")
                    ,DB::raw("'0' as D26")
                    ,DB::raw("'0' as D27")
                    ,DB::raw("'0' as D28")
                    ,DB::raw("'0' as D29")
                    ,DB::raw("'0' as D30")
                    ,DB::raw("'0' as D31")
                    ,DB::raw("'0' as sum_ps")
                    ,DB::raw("'0' as sum_as_y")
                    ,DB::raw("'0' as sum_as_n")
                    ,DB::raw("'0' as sum_no_ts")
                    ,'users.id','users.email')
                ->where('position_id','=','2')
                ->whereBetween('date',[substr($date, 0, 8).'01',substr($date, 0, 8).'31'])
                ->get();

                foreach ($staff as $values) {
                    $sum_ps = 0;
                    $sum_as_y = 0;
                    $sum_as_n = 0;
                    for($i = 1; $i <=31; $i++) {
                    if($i <10){
                        $i = '0'.$i;
                    }else{
                        $i = $i;
                    }
                    $item = 'D'.$i;
                    $check_time_01 = Timesheet::all()
                        ->where('user_id', '=', $values->id)
                        ->where('date', '=', substr($date, 0, 8) . $i);
                    if (count($check_time_01) > 0) {
                        foreach ($check_time_01 as $check_time){
                            if($check_time->logtime == 'present'){
                                $values->$item = '1';
                                $sum_ps = $sum_ps + 1;
                                $values->sum_ps = $sum_ps;
                            }else{
                                if($check_time->logtime == 'absent'){
                                    $values->$item = '2';
                                    $sum_as_y = $sum_as_y + 1;
                                    $values->sum_as_y = $sum_as_y;
                                }elseif($check_time->logtime == 'absent1'){
                                    $values->$item = '3';
                                    $sum_as_n = $sum_as_n + 1;
                                    $values->sum_as_n = $sum_as_n;
                                }
                            }
                        }
                    }
                }
            }
        }elseif ($roles->position_id == 2){
            $staff = DB::table('timesheets')
                ->rightJoin('users','timesheets.user_id','=','users.id')
                ->select(DB::raw('DISTINCT(users.last_name)')
                    ,DB::raw("'0' as D01")
                    ,DB::raw("'0' as D02")
                    ,DB::raw("'0' as D03")
                    ,DB::raw("'0' as D04")
                    ,DB::raw("'0' as D05")
                    ,DB::raw("'0' as D06")
                    ,DB::raw("'0' as D07")
                    ,DB::raw("'0' as D08")
                    ,DB::raw("'0' as D09")
                    ,DB::raw("'0' as D10")
                    ,DB::raw("'0' as D11")
                    ,DB::raw("'0' as D12")
                    ,DB::raw("'0' as D13")
                    ,DB::raw("'0' as D14")
                    ,DB::raw("'0' as D15")
                    ,DB::raw("'0' as D16")
                    ,DB::raw("'0' as D17")
                    ,DB::raw("'0' as D18")
                    ,DB::raw("'0' as D19")
                    ,DB::raw("'0' as D20")
                    ,DB::raw("'0' as D21")
                    ,DB::raw("'0' as D22")
                    ,DB::raw("'0' as D23")
                    ,DB::raw("'0' as D24")
                    ,DB::raw("'0' as D25")
                    ,DB::raw("'0' as D26")
                    ,DB::raw("'0' as D27")
                    ,DB::raw("'0' as D28")
                    ,DB::raw("'0' as D29")
                    ,DB::raw("'0' as D30")
                    ,DB::raw("'0' as D31")
                    ,DB::raw("'0' as sum_ps")
                    ,DB::raw("'0' as sum_as_y")
                    ,DB::raw("'0' as sum_as_n")
                    ,DB::raw("'0' as sum_no_ts")
                    ,'users.id','users.email')
                ->where('position_id','<>','1')
                ->where('position_id','<>','2')
                ->where('users.store_id','=',$roles->store_id)
                ->whereBetween('date',[substr($date, 0, 8).'01',substr($date, 0, 8).'31'])
                ->get();

            foreach ($staff as $values) {
                $sum_ps = 0;
                $sum_as_y = 0;
                $sum_as_n = 0;
                for($i = 1; $i <=31; $i++) {
                    if($i <10){
                        $i = '0'.$i;
                    }else{
                        $i = $i;
                    }
                    $item = 'D'.$i;
                    $check_time_01 = Timesheet::all()
                        ->where('user_id', '=', $values->id)
                        ->where('date', '=', substr($date, 0, 8) . $i);
                    if (count($check_time_01) > 0) {
                        foreach ($check_time_01 as $check_time){
                            if($check_time->logtime == 'present'){
                                $values->$item = '1';
                                $sum_ps = $sum_ps + 1;
                                $values->sum_ps = $sum_ps;
                            }else{
                                if($check_time->logtime == 'absent'){
                                    $values->$item = '2';
                                    $sum_as_y = $sum_as_y + 1;
                                    $values->sum_as_y = $sum_as_y;
                                }else{
                                    $values->$item = '3';
                                    $sum_as_n = $sum_as_n + 1;
                                    $values->sum_as_n = $sum_as_n;
                                }
                            }
                        }
                    }
                }
            }
        }
        return view('timesheets.quan_ly_cham_cong')->with(['staff'=>$staff,'auth'=>$roles,'date_now'=>$date_now,'month'=>$month]);
    }
    public function search_user_with_time(Request  $request){
        $user_id = Auth::id();
        $roles = User::find($user_id);
        $date = date("Y-m-d");
        $date_now = substr($date,-2,2);
        if($roles->position_id == 1){
            $staff = DB::table('timesheets')
                ->join('users','timesheets.user_id','=','users.id')
                ->select(DB::raw('DISTINCT(users.last_name)')
                    ,DB::raw("'0' as D01")
                    ,DB::raw("'0' as D02")
                    ,DB::raw("'0' as D03")
                    ,DB::raw("'0' as D04")
                    ,DB::raw("'0' as D05")
                    ,DB::raw("'0' as D06")
                    ,DB::raw("'0' as D07")
                    ,DB::raw("'0' as D08")
                    ,DB::raw("'0' as D09")
                    ,DB::raw("'0' as D10")
                    ,DB::raw("'0' as D11")
                    ,DB::raw("'0' as D12")
                    ,DB::raw("'0' as D13")
                    ,DB::raw("'0' as D14")
                    ,DB::raw("'0' as D15")
                    ,DB::raw("'0' as D16")
                    ,DB::raw("'0' as D17")
                    ,DB::raw("'0' as D18")
                    ,DB::raw("'0' as D19")
                    ,DB::raw("'0' as D20")
                    ,DB::raw("'0' as D21")
                    ,DB::raw("'0' as D22")
                    ,DB::raw("'0' as D23")
                    ,DB::raw("'0' as D24")
                    ,DB::raw("'0' as D25")
                    ,DB::raw("'0' as D26")
                    ,DB::raw("'0' as D27")
                    ,DB::raw("'0' as D28")
                    ,DB::raw("'0' as D29")
                    ,DB::raw("'0' as D30")
                    ,DB::raw("'0' as D31")
                    ,DB::raw("'0' as sum_ps")
                    ,DB::raw("'0' as sum_as_y")
                    ,DB::raw("'0' as sum_as_n")
                    ,DB::raw("'0' as sum_no_ts")
                    ,'users.id','users.email')
                ->where('position_id','=','2')
                ->where('date','like','%'.$request->month.'%')
                ->where('users.last_name','like','%'.$request->name_user.'%')
                ->get();
                foreach ($staff as $values) {
                    $sum_ps = 0;
                    $sum_as_y = 0;
                    $sum_as_n = 0;
                    for($i = 1; $i <=31; $i++) {
                    if($i <10){
                        $i = '0'.$i;
                    }else{
                        $i = $i;
                    }
                    $item = 'D'.$i;
                    $check_time_01 = Timesheet::all()
                        ->where('user_id', '=', $values->id)
                        ->where('date', '=', $request->month .'-'. $i);
                    if (count($check_time_01) > 0) {
                        foreach ($check_time_01 as $check_time){
                            if($check_time->logtime == 'present'){
                                $values->$item = '1';
                                $sum_ps = $sum_ps + 1;
                                $values->sum_ps = $sum_ps;
                            }else{
                                if($check_time->logtime == 'absent'){
                                    $values->$item = '2';
                                    $sum_as_y = $sum_as_y + 1;
                                    $values->sum_as_y = $sum_as_y;
                                }else{
                                    $values->$item = '3';
                                    $sum_as_n = $sum_as_n + 1;
                                    $values->sum_as_n = $sum_as_n;
                                }
                            }
                        }
                    }
                }
            }
        }elseif ($roles->position_id == 2){
            $staff = DB::table('timesheets')
                ->rightJoin('users','timesheets.user_id','=','users.id')
                ->select(DB::raw('DISTINCT(users.last_name)')
                    ,DB::raw("'0' as D01")
                    ,DB::raw("'0' as D02")
                    ,DB::raw("'0' as D03")
                    ,DB::raw("'0' as D04")
                    ,DB::raw("'0' as D05")
                    ,DB::raw("'0' as D06")
                    ,DB::raw("'0' as D07")
                    ,DB::raw("'0' as D08")
                    ,DB::raw("'0' as D09")
                    ,DB::raw("'0' as D10")
                    ,DB::raw("'0' as D11")
                    ,DB::raw("'0' as D12")
                    ,DB::raw("'0' as D13")
                    ,DB::raw("'0' as D14")
                    ,DB::raw("'0' as D15")
                    ,DB::raw("'0' as D16")
                    ,DB::raw("'0' as D17")
                    ,DB::raw("'0' as D18")
                    ,DB::raw("'0' as D19")
                    ,DB::raw("'0' as D20")
                    ,DB::raw("'0' as D21")
                    ,DB::raw("'0' as D22")
                    ,DB::raw("'0' as D23")
                    ,DB::raw("'0' as D24")
                    ,DB::raw("'0' as D25")
                    ,DB::raw("'0' as D26")
                    ,DB::raw("'0' as D27")
                    ,DB::raw("'0' as D28")
                    ,DB::raw("'0' as D29")
                    ,DB::raw("'0' as D30")
                    ,DB::raw("'0' as D31")
                    ,DB::raw("'0' as sum_ps")
                    ,DB::raw("'0' as sum_as_y")
                    ,DB::raw("'0' as sum_as_n")
                    ,DB::raw("'0' as sum_no_ts")
                    ,'users.id','users.email')
                ->where('position_id','<>','1')
                ->where('position_id','<>','2')
                ->where('users.store_id','=',$roles->store_id)
                ->where('date','like','%'.$request->month.'%')
                ->where('users.last_name','like','%'.$request->name_user.'%')
                ->get();
            foreach ($staff as $values) {
                $sum_ps = 0;
                $sum_as_y = 0;
                $sum_as_n = 0;
                for($i = 1; $i <=31; $i++) {
                    if($i <10){
                        $i = '0'.$i;
                    }else{
                        $i = $i;
                    }
                    $item = 'D'.$i;
                    $check_time_01 = Timesheet::all()
                        ->where('user_id', '=', $values->id)
                        ->where('date', '=', substr($date, 0, 8) . $i);
                    if (count($check_time_01) > 0) {
                        foreach ($check_time_01 as $check_time){
                            if($check_time->logtime == 'present'){
                                $values->$item = '1';
                                $sum_ps = $sum_ps + 1;
                                $values->sum_ps = $sum_ps;
                            }else{
                                if($check_time->logtime == 'absent'){
                                    $values->$item = '2';
                                    $sum_as_y = $sum_as_y + 1;
                                    $values->sum_as_y = $sum_as_y;
                                }else{
                                    $values->$item = '3';
                                    $sum_as_n = $sum_as_n + 1;
                                    $values->sum_as_n = $sum_as_n;
                                }
                            }
                        }
                    }
                }
            }
        }
        $result = null;
        foreach ($staff as $key=>$value){
            $result .= '<tr >';
            $result .= '<td>'.$value->last_name.' ('.$value->email.')</td>';
            $result .= '<td><button style="height: 15px;width: 5px; background-color: green"></button><a>:'.($value->sum_ps).'</a>
                                <button style="height: 15px;width: 5px; background-color: orange"></button><a>:'.($value->sum_as_y).'</a>
                                <button style="height: 15px;width: 5px; background-color: red"></button><a>:'.($value->sum_as_n).'</a></td>';
            for($i = 1;$i <= 31;$i++)
            {
                if ($i < 10) {
                    $item = 'D0' . $i;
                    $date_search = $request->month.'-0'.$i;
                } else {
                    $item = 'D' . $i;
                    $date_search = $request->month.'-'.$i;
                }
                if($value->$item == 0){
                    $result .= '<td ><a href="'.route('show_view_update_time_sheet',['id'=>$value->id,'date'=>$date_search]).'"
                                        data-toggle="modal" data-target="#modal-admin-update-request-timesheet"  type = "button" style = "width: 40px;height: 40px;background-color: gray;"></a ></td >';
                }elseif ($value->$item == 1){
                    $result .= '<td ><a href="'.route('show_view_update_time_sheet',['id'=>$value->id,'date'=>$date_search]).'"
                                        data-toggle="modal" data-target="#modal-admin-update-request-timesheet" type = "button" style = "width: 40px;height: 40px;background-color: green;"></a ></td >';
                }elseif ($value->$item == 2){
                    $result .= '<td ><a href="'.route('show_view_update_time_sheet',['id'=>$value->id,'date'=>$date_search]).'"
                                        data-toggle="modal" data-target="#modal-admin-update-request-timesheet" type = "button" style = "width: 40px;height: 40px;background-color: orange;"></a ></td >';
                }
                else{
                    $result .= '<td ><a href="'.route('show_view_update_time_sheet',['id'=>$value->id,'date'=>$date_search]).'"
                                        data-toggle="modal" data-target="#modal-admin-update-request-timesheet" type = "button" style = "width: 40px;height: 40px;background-color: red;"></a ></td >';
                }
            }
        }
        $result .= '</tr>';
        return $result;
    }

    public function viewRequestStaff($id){
        $time_sheet = Timesheet::find($id);
//        dd($time_sheet->id);
        return view('timesheets.view_request_timesheet')->with(['time_request'=>$time_sheet]);
    }

    public function updateWithRequest(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtComment'=> 'required',
            'txtRequest' => 'required'
        ]);
        $noti= array(
            'message' => ' Cập nhật lỗi! Hãy kiểm tra lại thông tin và nhập lại !',
            'alert-type' => 'error'
        );
        if ($validator->fails()) {
            return Redirect::back()
                ->with($noti)
                ->withErrors($validator)
                ->withInput();
        }
        $data_request_update =DB::table('timesheets')->where('id','=',$request->user_id)
            ->update([
                'reason_request'=>$request->txtComment,
                'request'=>$request->txtRequest,
                'status'=>"pendding"
            ]);
        if($data_request_update = 1){
            $notification = array(
                'message' => 'Thêm thông tin thành công!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Thêm thông tin không thành công!',
                'alert-type' => 'success'
            );
        }
        return Redirect::back()->with($notification);
    }

    public function updateTimesheetWithTime($id){
        $time_request = Timesheet::find($id);
        $use_infor = User::find($time_request->user_id);
        return view('timesheets.view_request_to_update')->with(['time_request'=>$time_request,'user_infor'=>$use_infor]);
    }

    public function updateStatusTimesheetWithTime(Request $request){
        if($request->user_id == null){
            $add_time_sheet = DB::table('timesheets')->insert([
                'user_id'=> $request->user_id_logtime,
                'date' => $request->date_ts,
                'logtime' => $request->status_timesheet,
                'status' => 'done',
                'comment' => $request->txtComment,
                'start_time'=>$request->txtTimeStart,
                'end_time' =>$request->txtTimeEnd
            ]);
        }else {
            $data_request_dimiss = DB::table('timesheets')->where('id', '=', $request->user_id)
                ->update([
                    'logtime' => $request->status_timesheet,
                    'comment' => $request->txtComment,
                    'start_time' => $request->txtTimeStart,
                    'end_time' => $request->txtTimeEnd
                ]);
        }
        if($data_area_update = 1){
            $notification = array(
                'message' => 'thành công!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'không thành công!',
                'alert-type' => 'success'
            );
        }
        return Redirect::back()->with($notification);
    }

    public function dismissTimesheetWithTime($id){
        $data_request_dimiss =DB::table('timesheets')->where('id','=',$id)
            ->update([
                'status'=>"done",
                'request'=>'reject'
            ]);
        if($data_area_update = 1){
            $notification = array(
                'message' => 'thành công!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'không thành công!',
                'alert-type' => 'success'
            );
        }
        return Redirect::back()->with($notification);
    }


    public function export_timesheet(Request $request){
        return Excel::download(new ExportTimesheetController($request),'Timesheets.xlsx');
    }
}
