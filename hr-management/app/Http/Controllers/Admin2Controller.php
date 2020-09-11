<?php

namespace App\Http\Controllers;

use App\Area;
use App\Group;
use App\Position;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Admin2Controller extends Controller
{
    public function index(){
        $list_user = User::leftJoin('positions','positions.position_id','=','users.position_id')
                    ->select('users.id','users.last_name','users.email','users.dob','users.phone','positions.position_name')
                    ->where('users.position_id','<>','1')
                    ->get();
        $area = Area::all();
        return view('admin2.create_acc')->with(['list_user'=>$list_user,'area'=>$area]);
    }

    public function search_user_update($id){
        $user = User::leftJoin('positions','positions.position_id','=','users.position_id')
            ->select('users.id','users.login','users.last_name','users.email','users.dob','users.phone','positions.position_name')
            ->find($id);
//        dd($user);
        return view('admin2.update_infor_user')->with(['user'=> $user]);
    }
    public function add_account_user(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtPassword' => 'required|max:250',
            'txtLName'=> 'required|max:50',
            'txtEmail' => 'required|email',
            'txtPhone' => 'required|max:11',
            'txtDob' => 'required',
            'txtAccUser'=> 'required',
        ]);
        $notification= array(
            'message' => ' Đăng ký  lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            if($request['txtAccUser'] == 'ASM'){
                $position = 7;
            }else{
                $position = 3;
            }
            $create_area = DB::table('users')->insert([
                'login'=> $request['txtName'],
                'password' => \Hash::make($request['txtPassword']),
                'last_name' => $request['txtLName'],
                'email' => $request['txtEmail'],
                'store_id' => 1,
                'department_id' => 1,
                'service_id' => 1,
                'position_id' => 1,
                'contract_id' => 1,
                'phone' => $request['txtPhone'],
                'dob' => $request['txtDob'],
                'position_id' => $position,
            ]);
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Tên hoặc Thông tin không chính xác! Vui lòng nhập lại ',
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
    public function update_account_user(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtLName'=> 'required|max:50',
            'txtEmail' => 'required',
            'txtPhone' => 'required',
            'txtDob' => 'required',
            'txtAccUser'=> 'required',
        ]);
        $notification= array(
            'message' => ' Cập Nhật lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            if($request->txtAccUser == 'ASM'){
                $position = 7;
            }else{
                $position = 3;
            }
            $update_user = DB::table('users')->where('id','=',$request->id_user)
                ->update([
                    'login'=>$request->txtName,
                    'last_name'=>$request->txtLName,
                    'email'=> $request->txtEmail,
                    'phone'=> $request->txtPhone,
                    'dob'=> $request->txtDob,
                    'position_id'=> $position,
                ]);
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Tên hoặc Thông tin không chính xác! Vui lòng nhập lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Cập nhật thông tin thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function group(){
        $group = Group::select('groups.*',DB::raw("'0'as sum_user"),DB::raw(" null as name_manager"))->get();
        $group_1 = Group::join('users as u1','u1.group_id','=','groups.id')
                    ->join('users as u2','u2.id','=','groups.manager')
                    ->select('groups.id','groups.name','groups.description','groups.manager','u2.last_name',DB::raw('COUNT(u1.id) as sum_user'))
                    ->groupBy('groups.id','groups.name','groups.description','groups.manager','u2.last_name')
                    ->get();
        $group_2 = Group::join('users as u1','u1.group_id','=','groups.id')
            ->select('groups.id','groups.name','groups.description','groups.manager',DB::raw('COUNT(u1.id) as sum_user'))
            ->groupBy('groups.id','groups.name','groups.description','groups.manager')
            ->get();
        foreach ($group as $value){
            foreach ($group_1 as $value_1){
                if ($value->id == $value_1->id){
                    $value->name_manager = $value_1->last_name;
                }
            }
        }
        foreach ($group as $value){
            foreach ($group_2 as $value_1){
                if ($value->id == $value_1->id){
                    $value->sum_user = $value_1->sum_user;
                }
            }
        }
        return view('admin2.group_manage')->with(['group'=>$group]);
    }

    public function createGroup(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtDescription' => 'required|max:250',
        ]);
        $notification= array(
            'message' => ' Thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $create_group = DB::table('groups')->insertGetId([
                'name'=> $request['txtName'],
                'description' => $request['txtDescription'],
            ]);
            $update_user = DB::table('groups')->where('id','=',$create_group)
                ->update([
                    'id_group'=>'MPS'.$create_group,
                ]);
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Tên hoặc Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function view_information(){
        return view('admin2.update_information_auth');
    }

    public function addUserToGroup($id){
        $user = User::select('id','last_name','email','dob','phone')
                ->join('positions','users.position_id','=','positions.position_id')
                ->where('positions.position_name','<>','ASM')
                ->where('positions.position_name','<>','Admin')
                ->where('users.group_id','=',null)
                ->get();
        return view('admin2.add_user_to_group')->with(['user'=>$user,'id_group'=>$id]);
    }

    public function insertUserToGroup(Request $request){
        $arr = $request->toArray();
        $arr_id_group = explode('_',$request->id_group);
        $id_group = $arr_id_group[0];
        $arr_id = [];
        foreach ($arr as $value){
            if(is_numeric($value)){
                array_push($arr_id,$value);
            }
        }
        try {
            foreach ($arr_id as $value) {
                $update_user = DB::table('users')->where('id', '=', $value)
                    ->update([
                        'group_id' => $id_group,
                    ]);
            }
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Lỗi ! Vui lòng nhập lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Thêm vào nhóm thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function viewHanMuc(){
        $user = User::join('positions','users.position_id','=','positions.position_id')
            ->where('positions.position_name','<>','ASM')
            ->where('positions.position_name','<>','Admin')
            ->where('type','=',null)
            ->get();
        $area = Area::all();
        return view('admin2.han_muc_thu_tien')->with(['user'=>$user,'area'=>$area]);
    }

    public function lockAccUser(){
        return view('admin2.lock_unlock_account');
    }

    public function addASMToGroup($id){
        $user = User::select('id','last_name','email','dob','phone')
            ->join('positions','users.position_id','=','positions.position_id')
            ->where('positions.position_name','=','ASM')
            ->where('users.group_id','=',null);
        $id_manager = Group::find($id);
        $arr_id_manager = explode(',',$id_manager->manager);
        foreach ($arr_id_manager as $value){
            $user = $user->where('id','<>',$value);
        }
        return view('admin2.add_asm_to_group')->with(['user'=>$user->get(),'id_group'=>$id]);
    }

    public function insertASMforGroup(Request $request){
        $arr = $request->toArray();
        $arr_id_group = explode('_',$request->id_group);
        $id_group = $arr_id_group[0];
        $arr_id = [];
        foreach ($arr as $value){
            if(is_numeric($value)){
                array_push($arr_id,$value);
            }
        }
        try {
            $str = null;
            foreach ($arr_id as $value) {
                $str = $str.','.$value;
            }
            $str_result = substr($str,1,strlen($str)-1);
            $arr_id_group_old = Group::find($id_group)->manager;
            $str_result = $arr_id_group_old.','.$str_result;
            $update_group = DB::table('groups')->where('id', '=', $id_group)
                ->update([
                    'manager' => $str_result,
                ]);
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Lỗi ! Vui lòng nhập lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Thêm vào nhóm thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }
}
