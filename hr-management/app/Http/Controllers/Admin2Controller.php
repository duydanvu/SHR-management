<?php

namespace App\Http\Controllers;

use App\Area;
use App\Group;
use App\Imports\UsersImport;
use App\Position;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            if($request['txtAccUser'] == 'user1'){
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
            if($request->txtAccUser == 'user1'){
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
        $group_1 = Group::leftJoin('users as u1','u1.group_id','=','groups.id')
                    ->join('users as u2','u2.id','=','groups.manager')
                    ->select('groups.id','groups.name','groups.description','groups.manager','u2.last_name',DB::raw('COUNT(u1.id) as sum_user'))
                    ->groupBy('groups.id','groups.name','groups.description','groups.manager','u2.last_name')
                    ->get();
//        dd($group_1);
        $group_2 = Group::leftJoin('users as u1','u1.group_id','=','groups.id')
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
//        dd($group);
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

    public function list_user_of_group($id){
        $user = User::select('id','last_name','email','dob','phone')
                ->where('group_id','=',$id)->get();
        $group = Group::find($id);
        return view('admin2.list_user_of_group')->with(['user'=>$user,'group'=>$group]);
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
    public function leave_user_from_group(Request $request){
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
                        'group_id' => null,
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
            'message' => 'Rời nhóm thành công!',
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
        $user = User::join('positions','users.position_id','=','positions.position_id')
            ->where('positions.position_name','<>','Admin')
            ->where('activation_key','<>',null)
            ->where('type','=',null)
            ->get();
        $area = Area::all();
        return view('admin2.lock_unlock_account')->with(['user'=>$user,'area'=>$area]);
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
            if($arr_id_group_old == null){
                $str_result = $str_result;
            }else {
                $str_result = $arr_id_group_old . ',' . $str_result;
            }
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

    public function view_han_muc_user($id){
        $user = User::find($id);
        return view('admin2.tao_han_muc')->with(['user'=>$user]);
    }

    public function update_han_muc(Request $request){
        try {
            $update_group = DB::table('users')->where('id', '=', $request->id_users1)
                ->update([
                    'han_muc' => $request->txtLimit,
                ]);
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Lỗi ! Vui lòng nhập lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Cập nhật thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function view_lock_account($id){
        $user = User::find($id);
        return view('admin2.lock_account')->with(['user'=>$user]);
    }

    public function action_lock_account(Request $request){
        try {
            $update_group = DB::table('users')->where('id', '=', $request->id_users1)
                ->update([
                    'activation_key' => null,
                ]);
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Lỗi ! Vui lòng thử lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Khóa Thành Công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function searchListAccAdminLv2(Request  $request){
        $list_user = User::leftJoin('positions','positions.position_id','=','users.position_id')
            ->join('stores','stores.store_id','=','users.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->select('users.id','users.last_name','users.email','users.dob','users.phone','positions.position_name')
//            ->where('users.last_name','like','%'.$request->name_user.'%')
//            ->where('area.id','=',$request->area_search)
            ->where('users.position_id','<>','1');
//            ->get();
        if($request->area_search == 'all'){
           $area_list_user = $list_user;
        }else{
            $area_list_user = $list_user->where('area.id','=',$request->area_search);
        }

        if ($request->name_user == null){
            $name_list_user = $area_list_user;
        }else{
            $name_list_user = $area_list_user->where('users.last_name','like','%'.$request->name_user.'%');
        }

        $result = null;
        foreach ($name_list_user->get() as $key=>$value){
            $result .= '<tr>';
            $result .= '<td>'.($key+1).'</td>';
            $result .= '<td class="text-center">
                                        <a href="'.route('search_view_update_user',['id'=>$value->id]).'" data-remote="false"
                                           data-toggle="modal" data-target="#modal-admin-action-update" class="btn dropdown-item">
                                            <i class="fas fa-edit"> Sửa</i>
                                        </a>
                            </td>';
            $result .= '<td>'.($value->last_name).'</td>';
            $result .= '<td>'.($value->email).'</td>';
            $result .= '<td>'.($value->dob).'</td>';
            $result .= '<td>'.($value->phone).'</td>';
            if($value->position_name == 'ASM'){
                $result .= '<td>'.($value->position_name).'</td>';
            }else {
                $result .= '<td>UserLV2</td>';
            }
            $result .= '</tr>';
        }
        return $result;

    }

    public function search_han_muc_thu_tien(Request $request){
        $user = User::join('positions','users.position_id','=','positions.position_id')
            ->join('stores','stores.store_id','=','users.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->where('positions.position_name','<>','ASM')
            ->where('positions.position_name','<>','Admin')
            ->where('type','=',null);
//            ->get();

        if($request->area_search == 'all'){
            $area_list_user = $user;
        }else{
            $area_list_user = $user->where('area.id','=',$request->area_search);
        }

        if ($request->name_user == null){
            $name_list_user = $area_list_user;
        }else{
            $name_list_user = $area_list_user->where('users.last_name','like','%'.$request->name_user.'%');
        }
        $result = null;

        foreach ($name_list_user->get() as $key=>$value){
            $result .= '<tr>';
            $result .= '<td>'.($key+1).'</td>';
            $result .= '<td><a href="'.route('view_han_muc_tung_user',['id'=>$value->id]).'" data-remote="false"
                                    data-toggle="modal" data-target="#modal-create-member" class="btn dropdown-item">
                                    <i class="fas fa-money-bill"> Tạo Hạn Mức</i></a></td>';
            $result .= '<td>'.($value->han_muc).'</td>';
            $result .= '<td>'.($value->last_name).'</td>';
            $result .= '<td>'.($value->email).'</td>';
            $result .= '<td>'.($value->dob).'</td>';
            $result .= '<td>'.($value->phone).'</td>';
            $result .= '</tr>';
        }
        return $result;
    }

    public function search_account_active(Request $request){

        $user = User::join('positions','users.position_id','=','positions.position_id')
            ->join('stores','stores.store_id','=','users.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->where('positions.position_name','<>','Admin')
            ->where('activation_key','<>',null)
            ->where('type','=',null);
        if($request->area_search == 'all'){
            $area_list_user = $user;
        }else{
            $area_list_user = $user->where('area.id','=',$request->area_search);
        }

        if ($request->name_user == null){
            $name_list_user = $area_list_user;
        }else{
            $name_list_user = $area_list_user->where('users.last_name','like','%'.$request->name_user.'%');
        }
        $result = null;

        foreach ($name_list_user->get() as $key=>$value){
            $result .= '<tr>';
            $result .= '<td>'.($key+1).'</td>';
            $result .= '<td><a href="'.route('view_lock_account',['id'=>$value->id]).'" data-remote="false"
                                   data-toggle="modal" data-target="#modal-admin-action-update" class="btn dropdown-item">
                                   <i class="fas fa-lock"> Khóa Tài Khoản</i></a></td>';
            $result .= '<td>'.($value->last_name).'</td>';
            $result .= '<td>'.($value->email).'</td>';
            $result .= '<td>'.($value->dob).'</td>';
            $result .= '<td>'.($value->phone).'</td>';
            $result .= '<td> Đang hoạt động </td>';
            $result .= '</tr>';
        }
        return $result;
    }

    public function import_han_muc(Request $request){
        $path1 = $request->file('file')->store('temp');
        $path=storage_path('app').'/'.$path1;
        $data = \Excel::toArray(new UsersImport,$path);
        if(count($data[0]) > 0){
            foreach ($data as $key =>$value){
                foreach ($value as $key1 => $row) {
                    if($key1 > 0) {

                        $insert_data[] = array(
                            'email' => $row[1],
                            'han_muc' => $row[2]
                        );
                    }
                }
            }
//            dd($insert_data);
            if(!empty($insert_data))
            {
                foreach ($insert_data as $key=>$value){
                    $id_user = DB::table('users')->where('email','=',$value['email'])->get();
                    if($id_user) {
                        foreach ($id_user as $value2) {
                            $update_user = DB::table('users')->where('id', '=', $value2->id)
                                ->update([
                                    'han_muc' => $value['han_muc'],
                                ]);
                        }
                    }
                }
                $notification = array(
                    'message' => 'Import success!',
                    'alert-type' => 'success'
                );

            }
        }
        return back()->with($notification);
    }
    public function import_lock_acc(Request $request){
        $path1 = $request->file('file')->store('temp');
        $path=storage_path('app').'/'.$path1;
        $data = \Excel::toArray(new UsersImport,$path);
        if(count($data[0]) > 0){
            foreach ($data as $key =>$value){
                foreach ($value as $key1 => $row) {
                    if($key1 > 0) {

                        $insert_data[] = array(
                            'email' => $row[1]
                        );
                    }
                }
            }
//            dd($insert_data);
            if(!empty($insert_data))
            {
                foreach ($insert_data as $key=>$value){
                    $id_user = DB::table('users')->where('email','=',$value['email'])->get();
                    if(count($id_user) > 0) {
                        foreach ($id_user as $value2) {
                            $update_user = DB::table('users')->where('id', '=', $value2->id)
                                ->update([
                                    'activation_key' => null,
                                ]);
                        }
                    }
                }
                $notification = array(
                    'message' => 'Import success!',
                    'alert-type' => 'success'
                );

            }
        }
        return back()->with($notification);
    }

    public function update_password_for_user(Request $request){
        if(strcmp($request->txtPassword_new,$request->txtPassword_new_reenter) == 0){
            $login = Auth::user()->login;
            $credentials = [
                'login' => $login,
                'password' => $request->txtPassword_old,
            ];
            if(Auth::attempt($credentials)){
                $user_id = Auth::id();
                $update_user = DB::table('users')->where('id', '=', $user_id)
                    ->update([
                        'password' => Hash::make($request->txtPassword_new),
                    ]);
                $notification = array(
                    'message' => 'Cập Nhật Thành Công',
                    'alert-type' => 'success'
                );
            }else{
                $notification = array(
                    'message' => 'Mật khẩu nhập không chính xác!',
                    'alert-type' => 'error'
                );
            }

        }else{
            $notification = array(
                'message' => 'Cần nhập lại đúng mật khẩu mới!',
                'alert-type' => 'error'
            );
        }
        return Redirect::back()->with($notification);
    }

    public function update_information_auth_user(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtLName'=> 'required|max:50',
            'txtEmail' => 'required',
            'txtPhone' => 'required',
            'txtDob' => 'required',
            'txtGender'=> 'required',
        ]);
        $notification= array(
            'message' => ' Cập nhật lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $id_auth = Auth::id();
            $update_user = DB::table('users')->where('id','=',$id_auth)
                ->update([
                    'login'=>$request->txtName,
                    'last_name'=>$request->txtLName,
                    'email'=> $request->txtEmail,
                    'phone'=> $request->txtPhone,
                    'dob'=> $request->txtDob,
                    'gender'=> $request->txtGender,
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

    public function search_ajax_group_with_infor(Request $request){
        $group = Group::select('groups.*',DB::raw("'0'as sum_user"),DB::raw(" null as name_manager"))
            ->where('groups.name','like','%'.$request->name_user.'%')
            ->orwhere('groups.id_group','like','%'.$request->name_user.'%')
            ->get();
        $group_1 = Group::leftJoin('users as u1','u1.group_id','=','groups.id')
            ->join('users as u2','u2.id','=','groups.manager')
            ->select('groups.id','groups.name','groups.description','groups.manager','u2.last_name',DB::raw('COUNT(u1.id) as sum_user'))
            ->groupBy('groups.id','groups.name','groups.description','groups.manager','u2.last_name')
            ->get();
//        dd($group_1);
        $group_2 = Group::leftJoin('users as u1','u1.group_id','=','groups.id')
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
//        dd($group);
        foreach ($group as $value){
            foreach ($group_2 as $value_1){
                if ($value->id == $value_1->id){
                    $value->sum_user = $value_1->sum_user;
                }
            }
        }
        $result = null;
        foreach ($group as $key=>$value){
            $result .= '<tr>';
            $result .= '<td>'.($key+1).'</td>';
            $result .= '<td ><a href="'.route('add_user_to_group',['id'=>$value->id]).'">Thêm Người</a></td>';
            $result .= '<td ><a href="'.route('add_asm_to_group',['id'=>$value->id]).'">Thêm Quản Lý</a></td>';
            $result .= '<td>'.($value->id_group).'</td>';
            $result .= '<td>'.($value->name).'</td>';
            $result .= '<td>'.($value->description).'</td>';
            $result .= '<td>'.($value->name_manager).'</td>';
            $result .= '<td>'.($value->sum_user).'</td>';
            $result .= '</tr>';
        }
        return $result;
    }
}
