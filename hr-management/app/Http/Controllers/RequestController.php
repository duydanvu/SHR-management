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
use Ramsey\Uuid\Type\Time;

class RequestController extends Controller
{
    public function logsTimesheets(){
        $user_id = Auth::id();
        $roles = User::find($user_id);
        $date = date("Y-m-d");
        $timesheet = Timesheet::where('date','=',$date)->select('user_id')->get();
        if($roles->position_id == 1){
            $staff = DB::table('users')->join('timesheets','timesheets.user_id','=','users.id')
                ->where('position_id','=',2)
                ->where('status','=','pendding')
                ->select('users.*','timesheets.id as id_timesheet','timesheets.date as date_timesheet')
                ->get();
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
        $user = User::join('stores','users.store_id','=','stores.store_id')
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
            -> addSelect(DB::raw("'0' as absent_no"))
            ->get();
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
            'department' => $department,
            'service'=>$service,
            'contract'=>$contract,
            'user'=>$user]);
    }

    public function searchTimesheet(Request $request){
        $result = null;
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
            -> addSelect(DB::raw("'0' as present"))
            -> addSelect(DB::raw("'0' as absent_yes"))
            -> addSelect(DB::raw("'0' as absent_no"));

        if($request->area_search === 'all'){
            $user_area = $user;
        }else{
            $user_area = $user->where('stores.area_id','=',$request->area_search);
        }

        if($request->store_search === 'all'){
            $user_store = $user_area;
        }else{
            $user_store = $user_area->where('users.store_id','=',$request->store_search);
        }

        if($request->position_search === 'all'){
            $user_position = $user_store;
        }else{
            $user_position = $user_store->where('users.position_id','=',$request->position_search);
        }

        if($request->contract_search === 'all'){
            $user_contract = $user_position;
        }else{
            $user_contract = $user_position->where('users.contract_id','=',$request->contract_search);
        }

        if($request->department_search === 'all'){
            $user_department = $user_contract;
        }else{
            $user_department = $user_contract->where('users.department_id','=',$request->department_search);
        }
        if($request->service_search === 'all'){
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

    public function updateTimesheet($id){
        $timesheet = Timesheet::find($id);
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
        if (strcmp($date,$request['txtdate']) != 0 ){
            $notification= array(
                'message' => ' Nhập đúng ngày hiện tại để điểm danh !!',
                'alert-type' => 'error'
            );
            return Redirect::back()
                ->with($notification)
                ->withInput();
        }
        $validator = \Validator::make($request->all(),[
            'user_id' => 'required|max:11',
            'txtdate' => 'required|date',
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
                'date' => $request['txtdate'],
                'logtime' => $request['status_timesheet'],
                'status' => 'done',
                'comment' => $request['txtComment']
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

    public function addTimesheetCht(Request $request){
        $date = date("Y-m-d");
        $user_id = Auth::id();
        $roles = User::find($user_id);
        if (strcmp($date,$request['txtdate']) != 0 ){
            $notification= array(
                'message' => ' Nhập đúng ngày hiện tại để điểm danh !!',
                'alert-type' => 'error'
            );
            return Redirect::back()
                ->with($notification)
                ->withInput();
        }
        $validator = \Validator::make($request->all(),[
            'txtIDCht' => 'required|max:11',
            'txtdate' => 'required|date',
            'status_timesheet' => 'required|max:8'
        ]);
        $notification= array(
            'message' => ' Chấm công lỗi! Kiểm tra thông tin và nhập lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        $check_request_cht = DB::table('timesheets')->select('id')
                            ->where('user_id','=',$request['txtIDCht'])
                            ->where('date','=',$request['txtdate'])
                            ->get();
        foreach ($check_request_cht as $value_check){
            $id_check = $value_check->id;
        }
        if(count($check_request_cht) == 0) {
            try {
                $add_time_sheet = DB::table('timesheets')->insert([
                    'user_id' => $request['txtIDCht'],
                    'date' => $request['txtdate'],
                    'logtime' => $request['status_timesheet'],
                    'comment' => $request['txtDescription']
                ]);
            } catch (QueryException $ex) {
                $notification = array(
                    'message' => 'Chấm công nhân viên lỗi! Vui lòng nhập lại ',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }
        }else{
            try {
                $update_time_sheet = DB::table('timesheets')->where('id','=',$id_check)
                    ->update([
                    'user_id' => $request['txtIDCht'],
                    'date' => $request['txtdate'],
                    'logtime' => $request['status_timesheet'],
                    'comment' => $request['txtDescription']
                ]);
            } catch (QueryException $ex) {
                $notification = array(
                    'message' => 'Chấm công nhân viên lỗi! Vui lòng nhập lại ',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }
        }
        $notification = array(
            'message' => 'Chấm công nhân viên thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function checkRequest(){
        $user_id = Auth::id();
        $roles = User::find($user_id);
        if($roles->position_id == 1){
            $staff = DB::table('timesheets')->join('users','timesheets.user_id','=','users.id')
                ->join('stores','users.store_id','=','stores.store_id')
                ->join('positions','users.position_id','=','positions.position_id')
                ->join('departments','users.department_id','=','departments.id')
                ->select('users.*','timesheets.id as id_timesheet','stores.store_name',
                    'positions.position_name','departments.name as dp_name','timesheets.status as status_timesheet','timesheets.logtime as logs_timesheet',
                    'timesheets.comment as comment_timesheet','timesheets.request as request_timesheet','timesheets.date as date_timesheet')
                ->get();
        }elseif ($roles->position_id == 2){
            $staff = DB::table('timesheets')
                ->leftJoin('users','timesheets.user_id','=','users.id')
                ->join('stores','users.store_id','=','stores.store_id')
                ->join('positions','users.position_id','=','positions.position_id')
                ->join('departments','users.department_id','=','departments.id')
                ->where('users.position_id','=',3)
                ->where('users.store_id','=',$roles->store_id)
                ->where('timesheets.status','=','done')
                ->select('users.*','timesheets.id as id_timesheet','stores.store_name',
                    'positions.position_name','departments.name as dp_name','timesheets.status as status_timesheet','timesheets.logtime as logs_timesheet',
                    'timesheets.comment as comment_timesheet','timesheets.request as request_timesheet','timesheets.date as date_timesheet')
                ->get();
        }
        return view('timesheets.check_request_staff')->with(['staff'=>$staff,'auth'=>$roles]);
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
        $data_request_dimiss =DB::table('timesheets')->where('id','=',$request->timesheet_id)
            ->update([
                'logtime' =>$request->status_timesheet,
                'comment'=>$request->txtReason,
                'status'=>"done",
                'request'=>"done"
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

}
