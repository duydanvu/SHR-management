<?php

namespace App\Http\Controllers;

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
                ->select('users.*','timesheets.id as id_timesheet');
        }elseif ($roles->position_id == 2){
            $staff = User::all()->where('position_id','=',1)
                                ->where('store_id','=',$roles->store_id);
            foreach ($timesheet as $value){
                $staff = $staff->where('id','!=',$value->user_id);
            }
        }
        return view('timesheets.log_timesheets')->with(['staff'=>$staff->get()]);
    }

    public function addViewTimesheet($id){
        $user = User::find($id);
        return view('timesheets.add_time_sheet')->with(['user'=>$user]);
    }

    public function updateTimesheet($id){
        $timesheet = Timesheet::find($id);
        return view('timesheets.update_time_sheet')->with(['user_timesheet'=>$timesheet]);
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
            'status_timesheet' => 'required|max:8',
            'txtComment' => 'required'
        ]);
        $notification= array(
            'message' => ' Đăng ký cửa hàng lỗi! Hãy chọn phần tạo tài khoản và nhập lại thông tin!',
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
                'status' => $request['status_timesheet'],
                'comment' => $request['txtComment']
            ]);
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Thêm thông tin không chính xác! Vui lòng nhập lại ',
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
        if($roles->position_id == 1){
            $staff = DB::table('users')->join('timesheets','timesheets.user_id','=','users.id')
                ->join('stores','users.store_id','=','stores.store_id')
                ->join('positions','users.position_id','=','positions.position_id')
                ->join('departments','users.department_id','=','departments.id')
                ->select('users.*','timesheets.id as id_timesheet','stores.store_name',
                    'positions.position_name','departments.name as dp_name','timesheets.status as status_timesheet',
                    'timesheets.comment as comment_timesheet','timesheets.request as request_timesheet','timesheets.date as date_timesheet')
                ->get();
        }elseif ($roles->position_id == 2){
            $staff = DB::table('users')->join('timesheets','timesheets.user_id','=','users.id')
                ->join('stores','users.store_id','=','stores.store_id')
                ->join('positions','users.position_id','=','positions.position_id')
                ->join('departments','users.department_id','=','departments.id')
                ->where('position_id','=',1)
                ->where('store_id','=',$roles->store_id)
                ->select('users.*','timesheets.id as id_timesheet','stores.store_name',
                    'positions.position_name','departments.name as dp_name','timesheets.status as status_timesheet',
                    'timesheets.comment as comment_timesheet','timesheets.request as request_timesheet','timesheets.date as date_timesheet')
                ->get();
        }
        return view('timesheets.check_request_staff')->with(['staff'=>$staff]);
    }
}
