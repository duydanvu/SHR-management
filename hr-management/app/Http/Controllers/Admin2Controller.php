<?php

namespace App\Http\Controllers;

use App\Area;
use App\Emulation;
use App\EmulationProducts;
use App\Gift;
use App\GoalProduct;
use App\GoalSales;
use App\Group;
use App\Imports\UsersImport;
use App\Position;
use App\Products;
use App\Reward;
use App\SalesProducts;
use App\Supplier;
use App\TotalProductEmulation;
use App\Transports;
use App\TypeCode;
use App\User;
use App\UserProduct;
use App\W2W;
use App\Warehouse;
use App\WarehouseProduct;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

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
                $position = 1;
            }else{
                $position = 3;
            }
            $create_area = DB::table('users')->insertGetId([
                'login'=> $request['txtName'],
                'password' => \Hash::make($request['txtPassword']),
                'last_name' => $request['txtLName'],
                'email' => $request['txtEmail'],
                'store_id' => 1,
                'department_id' => 1,
                'service_id' => 1,
                'contract_id' => 1,
                'phone' => $request['txtPhone'],
                'dob' => $request['txtDob'],
                'position_id' => $position,
                'type'=>'systems',
                'activation_key'=> 'active'
            ]);
            if($request['txtAccUser'] == 'user1' ){
                $insert = DB::table('user_action')->insert([
                    'user_id'=>$create_area,
                    'action_id'=> 3
                ]);
                $insert = DB::table('user_action')->insert([
                    'user_id'=>$create_area,
                    'action_id'=> 6
                ]);
            }else{
                $insert = DB::table('user_action')->insert([
                    'user_id'=>$create_area,
                    'action_id'=> 3
                ]);
            }
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
            'txtPassword'=> 'required',
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
                $position = 1;
            }else{
                $position = 3;
            }
            $update_user = DB::table('users')->where('id','=',$request->id_user)
                ->update([
                    'login'=>$request->txtName,
                    'last_name'=>$request->txtLName,
                    'password'=>$request->txtPassword,
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
            $list_product = DB::table('user_products')->where('id_group','=',$id_group)
                ->select('id_product')->distinct()->get();
            foreach ($list_product as $values){
                foreach ($arr_id as $value_id) {
                    $insert_user_products = DB::table('user_products')->insert([
                        'id_user' => $value_id,
                        'id_product' => $values->id_product,
                        'id_group' => $id_group,
                        'status' => 'active',
                    ]);
                }
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
            foreach ($arr_id as $key=>$values){
                if($key == 0) {
                    $id_user_product = UserProduct::where('id_user', '=', $values)
                        ->where('id_group', '=', $id_group);
                }$id_user_product = UserProduct::where('id_user', '=', $values)
                    ->where('id_group', '=', $id_group)->union($id_user_product);
            }
            foreach ($id_user_product->get() as $value_dele){
                DB::table('user_products')->delete($value_dele->id);
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

    public function index_supplier(){
        $spl = Supplier::all();
        return view('admin2.index_supplier',compact('spl'));
    }

    public function addSupplier(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtAddress' => 'required|max:250',
            'txtPhone' => 'required',
            'txtContract' => 'required'
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $create_spl = DB::table('suppliers')->insertGetId([
                'name'=> $request['txtName'],
                'address' => $request['txtAddress'],
                'phone'=> $request['txtPhone'],
                'contract_tc'=> $request['txtContract'],
            ]);
            $supplier_code = 'SPL_'.$create_spl;
            $update_user = DB::table('suppliers')->where('id', '=', $create_spl)
                ->update([
                    'supply_code' => $supplier_code,
                ]);
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function searchSupplier($id){
        $spl = Supplier::find($id);
        return view('admin2.update_infor_supplier',compact('spl'));
    }
    public function updateStatusSupplier($id){
        $spl = Supplier::find($id);
        try{
            if($spl->status == 'active') {
                $update_spl = DB::table('suppliers')->where('id', '=', $id)
                    ->update([
                        'status' => 'stop',
                    ]);
            }elseif ($spl->status == 'stop'){
                $update_spl = DB::table('suppliers')->where('id', '=', $id)
                    ->update([
                        'status' => 'active',
                    ]);
            }
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thực hiện cập nhật kho lỗi',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Cập nhật trang thái kho thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function updateSupplier(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtAddress' => 'required|max:250',
            'txtPhone' => 'required',
            'txtContract' => 'required'
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $update_user = DB::table('suppliers')->where('id', '=', $request->id_spl)
                ->update([
                    'name' => $request->txtName,
                    'address' => $request->txtAddress,
                    'phone'=> $request->txtPhone,
                    'contract_tc'=>$request->txtContract,
                ]);
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function index_transporter(){
        $tsp = Transports::all();
        return view('admin2.index_transporter',compact('tsp'));
    }

    public function addTransporter(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtAddress' => 'required|max:250',
            'txtPhone' => 'required',
            'txtContract' => 'required'
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $create_tsp = DB::table('transports')->insertGetId([
                'name'=> $request['txtName'],
                'address' => $request['txtAddress'],
                'phone'=> $request['txtPhone'],
                'contract_tc'=> $request['txtContract'],
            ]);
            $trans_code = 'TSP_'.$create_tsp;
            $update_user = DB::table('transports')->where('id', '=', $create_tsp)
                ->update([
                    'trans_code' => $trans_code,
                ]);
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function searchTransporter($id){
        $tsp = Transports::find($id);
        return view('admin2.update_infor_transport',compact('tsp'));
    }

    public function updateStatusTransporter($id){
        $tsp = Transports::find($id);
        try{
            if($tsp->status == 'active') {
                $update_spl = DB::table('transports')->where('id', '=', $id)
                    ->update([
                        'status' => 'stop',
                    ]);
            }elseif ($tsp->status == 'stop'){
                $update_spl = DB::table('transports')->where('id', '=', $id)
                    ->update([
                        'status' => 'active',
                    ]);
            }
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thực hiện cập nhật kho lỗi',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Cập nhật trang thái kho thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function updateTransporter(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtAddress' => 'required|max:250',
            'txtPhone' => 'required',
            'txtContract' => 'required'
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $update_user = DB::table('transports')->where('id', '=', $request->id_spl)
                ->update([
                    'name' => $request->txtName,
                    'address' => $request->txtAddress,
                    'phone'=> $request->txtPhone,
                    'contract_tc'=>$request->txtContract,
                ]);
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function index_products(){
        $product = Products::all();
        $supplier = Supplier::where('status','=','active')->get();
        return view('admin2.index_products')->with(['product'=>$product,'supplier'=>$supplier]);
    }
    public function indexAddNewProducts(){
        $supplier = Supplier::where('status','=','active')->get();
        $type_code = TypeCode::all();
        return view('admin2.index_add_products',compact('supplier','type_code'));
    }

    public function addProduct(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtType' => 'required|max:250',
            'txtSupplier' => 'required',
            'txtTypeHT' => 'required',
            'txtContract' => 'required',
            'txtPriceIn' => 'required',
            'txtPriceOut' => 'required',
            'txtHH' => 'required',
            'txtPriceHH' => 'required',
            'txtPriceSale' => 'required',
            'url_image'=> 'required',
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $link_id_more_images = DB::table('link_image_wait_add_products')->get();
            if(sizeof($link_id_more_images) > 0){
                foreach ($link_id_more_images as $values_link){
                    $link_more_image = $values_link->link_wait;
                    $id_link_wait = $values_link->id;
                }
            }else{
                $link_more_image = null;
            }
            if($request->txtHH == 'codinh'){
                $create_pdu = DB::table('products')->insertGetId([
                    'name'=> $request['txtName'],
                    'type' => $request['txtType'],
                    'detail' => $request['editor1'],
                    'type_sale'=> $request['txtTypeCode'],
                    'type_sale_code'=> $request['txtTypeSaleCode'],
                    'link'=> $request['url_image'],
                    'forcus'=>$request['txtForcus'],
                    'id_supplier'=> $request['txtSupplier'],
                    'contract'=> $request['txtContract'],
                    'cooperation'=> $request['txtTypeHT'],
                    'price_in'=> $request['txtPriceIn'],
                    'price_out'=> $request['txtPriceOut'],
                    'price_sale'=> $request['txtPriceSale'],
                    'hh_default'=> $request['txtPriceHH'],
                    'id_link_detail'=>$link_more_image,
                    'hh_percent'=> null,
                ]);
            }elseif($request->txtHH == 'tile' && $request->txtPriceHH > 0 && $request->txtPriceHH < 100){
                $create_pdu = DB::table('products')->insertGetId([
                    'name'=> $request['txtName'],
                    'type' => $request['txtType'],
                    'detail' => $request['editor1'],
                    'type_sale'=> $request['txtTypeCode'],
                    'type_sale_code'=> $request['txtTypeSaleCode'],
                    'link'=> $request['url_image'],
                    'forcus'=>$request['txtForcus'],
                    'id_supplier'=> $request['txtSupplier'],
                    'contract'=> $request['txtContract'],
                    'cooperation'=> $request['txtTypeHT'],
                    'price_in'=> $request['txtPriceIn'],
                    'price_out'=> $request['txtPriceOut'],
                    'price_sale'=> $request['txtPriceSale'],
                    'hh_default'=> null,
                    'hh_percent'=> $request['txtPriceHH'],
                    'id_link_detail'=>$link_more_image,
                ]);
            }else{
                $notification = array(
                    'message' => 'Cần chọn hình thức hoa hồng và nhập đúng tỉ lệ hoa hồng cho sản phẩm!',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }

            if(!is_numeric($create_pdu)){
                if($link_more_image != null){
                    $delete_id = DB::table('link_image_wait_add_products')->delete($id_link_wait);
                }
                $notification = array(
                    'message' => 'Cần nhập đúng tỉ lệ hoa hồng cho sản phẩm! Vui lòng nhập lại ',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }else{
                if($link_more_image != null){
                    $delete_id = DB::table('link_image_wait_add_products')->delete($id_link_wait);
                }
                $product_code = 'PDU_'.$create_pdu;
                $update_user = DB::table('products')->where('id', '=', $create_pdu)
                    ->update([
                        'product_code' => $product_code,
                    ]);
            }
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function searchProduct($id){
        $product = Products::find($id);
        $supplier = Supplier::all();
        return view('admin2.update_infor_product',compact('product','supplier'));
    }

    public function updateStatusProduct($id){
        $product = Products::find($id);
        try{
            if($product->status == 'active') {
                $update_spl = DB::table('products')->where('id', '=', $id)
                    ->update([
                        'status' => 'stop',
                    ]);
            }elseif ($product->status == 'stop'){
                $update_spl = DB::table('products')->where('id', '=', $id)
                    ->update([
                        'status' => 'active',
                    ]);
            }
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thực hiện cập nhật kho lỗi',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Cập nhật trang thái kho thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function updateProduct(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtType' => 'required|max:250',
            'txtSupplier' => 'required',
            'txtTypeHT' => 'required',
            'txtContract' => 'required',
            'txtPriceIn' => 'required',
            'txtPriceOut' => 'required',
            'txtPriceSale' => 'required',
            'txtHH' => 'required',
            'txtPriceHH' => 'required',
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            if($request->txtHH == 'codinh'){
                $update_product = DB::table('products')->where('id', '=', $request->id_product)
                    ->update([
                        'name'=> $request['txtName'],
                        'type' => $request['txtType'],
                        'detail' => $request['editor1'],
                        'id_supplier'=> $request['txtSupplier'],
                        'contract'=> $request['txtContract'],
                        'cooperation'=> $request['txtTypeHT'],
                        'price_in'=> $request['txtPriceIn'],
                        'price_out'=> $request['txtPriceOut'],
                        'price_sale'=> $request['txtPriceSale'],
                        'hh_default'=> $request['txtPriceHH'],
                        'hh_percent'=> null,
                    ]);
            }
            elseif($request->txtHH == 'tile' && $request->txtPriceHH > 0 && $request->txtPriceHH < 100){
                $update_product = DB::table('products')->where('id', '=', $request->id_product)
                    ->update([
                        'name'=> $request['txtName'],
                        'type' => $request['txtType'],
                        'detail' => $request['editor1'],
                        'id_supplier'=> $request['txtSupplier'],
                        'contract'=> $request['txtContract'],
                        'cooperation'=> $request['txtTypeHT'],
                        'price_in'=> $request['txtPriceIn'],
                        'price_out'=> $request['txtPriceOut'],
                        'price_sale'=> $request['txtPriceSale'],
                        'hh_default'=> null,
                        'hh_percent'=> $request['txtPriceHH'],
                    ]);
            }
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function index_products_decentralization(){

        return view('admin2.index_products_decentralization');
    }

    public function receiveProductView($id){
        $date = date("Y-m-d H:i:s");
        $product = Products::find($id);
        $warehouse = Warehouse::where('status','=','active')->get();
        return view('admin2.nhap_san_pham',compact('product','warehouse','date'));
    }

    public function returnProductView($id){
        $date = date("Y-m-d");
        $product = Products::find($id);
        $warehouse = Warehouse::where('status','=','active')->get();
        return view('admin2.tra_san_pham',compact('product','warehouse','date'));
    }

    public function searchTotalProduct(Request $request){

            $total = WarehouseProduct::where('id_product','=',$request->id_product)
                ->where('id_warehouse','=',$request->id_wh)
                ->orderBy('id','desc')
                ->first();
            if($total == null){
                return 0;
            }else{
                return $total->total;
            }

    }

    public function importTotalProduct(Request $request){
//        dd(date("c",strtotime($request['txtDate'])));
        $date = date("Y-m-d");
        $tablename1 = substr($date,0,4);
        $tablename2 = substr($date,5,2);
        $tablename = 'iep_'.$tablename1.$tablename2;
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required',
            'txtWarehouse' => 'required',
            'txtContract_tc' => 'required',
            'txtTotalImport' => 'required',
            'txtDate' => 'required',
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $create_iep = DB::table($tablename)->insertGetId([
                'id_product'=> $request['id_product'],
                'id_warehouse' => $request['txtWarehouse'],
                'time'=> $request['txtDate'],
                'import_total'=> $request['txtTotalImport'],
                'total'=> $request['txtTotalImport'],
                'type'=>$request['txtTypeHT'],
            ]);
            $sum_import = DB::table($tablename)
                ->where('id_product','=',$request['id_product'])
                ->where('id_warehouse','=',$request['txtWarehouse'])
                ->where('time','<',$date)
                ->sum('import_total');
            $sum_export = DB::table($tablename)
                ->where('id_product','=',$request['id_product'])
                ->where('id_warehouse','=',$request['txtWarehouse'])
                ->where('time','<',$date)
                ->sum('export_total');
            $create_product_warehouse = DB::table('warehouse_products')->insert([
               'id_product'=> $request['id_product'],
                'id_warehouse' => $request['txtWarehouse'],
                'contract_tc'=> $request['txtContract_tc'],
                'time'=> $request['txtDate'],
                'total'=>($sum_import-$sum_export),
                'type'=>'import'
            ]);

        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Thêm thông tin nhập sản phẩm thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }
    public function exportTotalProduct(Request $request){
        $date = date("Y-m-d");
        $tablename1 = substr($date,0,4);
        $tablename2 = substr($date,5,2);
        $tablename = 'iep_'.$tablename1.$tablename2;
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required',
            'txtWarehouse' => 'required',
            'txtContract_tc' => 'required',
            'txtTotalExport' => 'required',
            'txtDate' => 'required',
            'txtTypeHT'=>'required',
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        if($request['txtDate'] < $date){
            $notification= array(
                'message' => ' Thời gian trả lớn hơn thời gian hiện tại!',
                'alert-type' => 'error'
            );
            return Redirect::back()
                ->with($notification)
                ->withInput();
        }
        if($request['txtTotalWarehouse'] < $request['txtTotalExport']){
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $create_iep = DB::table($tablename)->insertGetId([
                'id_product'=> $request['id_product'],
                'id_warehouse' => $request['txtWarehouse'],
                'time'=> $request['txtDate'],
                'export_total'=> $request['txtTotalExport'],
                'total'=> $request['txtTotalExport'],
                'type'=>$request['txtTypeHT'],
            ]);
            $sum_import = DB::table($tablename)
                ->where('id_product','=',$request['id_product'])
                ->where('id_warehouse','=',$request['txtWarehouse'])
                ->where('time','<',$date)
                ->sum('import_total');
            $sum_export = DB::table($tablename)
                ->where('id_product','=',$request['id_product'])
                ->where('id_warehouse','=',$request['txtWarehouse'])
                ->where('time','<',$date)
                ->sum('export_total');
            $create_product_warehouse = DB::table('warehouse_products')->insert([
               'id_product'=> $request['id_product'],
                'id_warehouse' => $request['txtWarehouse'],
                'contract_tc'=> $request['txtContract_tc'],
                'time'=> $request['txtDate'],
                'total'=>($sum_import-$sum_export),
                'type' => 'export'
            ]);

        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Thêm thông tin trả sản phẩm thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function products_decentralization_list_group($id){
        $list_group = Group::select('groups.*')->addSelect(DB::raw(" null as name_manager"));
        $arr_id_group = [];
        foreach ($list_group->get() as $value_group){
            $check_group_with_product = UserProduct::select('id')
                ->where('id_product','=',$id)
                ->where('id_group','=',$value_group->id)
                ->get();
            if(sizeof($check_group_with_product) >0){
                array_push($arr_id_group,$value_group->id);
            }
        }
        foreach ($arr_id_group as $value_check){
            $list_group = $list_group ->where('id','<>',$value_check);
        }
        $list_group_check = $list_group->get();
        foreach ($list_group_check as $key=>$values){
            $list_name = null;
            if($values->manager != null){
                $arr_id = explode(",",$values->manager);
                foreach ($arr_id as $value){
                    $name = User::select('last_name')->where('id','=',$value)->get();
                    foreach ($name as $name_value){
                        $list_name = $list_name .'-'.$name_value->last_name;
                    }
                }
            }
            $values->name_manager = substr($list_name,1);
        }
        return view('admin2.list_group_decentralization',compact('list_group_check','id'));
    }

    public function addProductForGroup(Request $request){
        $arr = $request->toArray();
        $arr_id_product = explode('_',$request->id_product);
        $id_product = $arr_id_product[0];
        $arr_id = [];
        foreach ($arr as $value){
            if(is_numeric($value)){
                array_push($arr_id,$value);
            }
        }
        try{
            foreach ($arr_id as $values){
                $id_user = User::select('id')->where('group_id','=',$values)->get();
                foreach ($id_user as $value_user){
                    $add_user_group = DB::table('user_products')->insert([
                        'id_user'=> $value_user->id,
                        'id_product' => $id_product,
                        'id_group' => $values,
                        'status'=> 'active',
                    ]);
                }
            }
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Lỗi ! Vui lòng nhập lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Phân quyền sản phẩm cho nhóm thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function chuyen_san_pham(){
        $product = Products::where('status','=','active')->get();
        $warehouse = Warehouse::where('status','=','active')->get();
        return view('admin2.chuyen_san_pham',compact('product','warehouse'));
    }

    public function transportProductToWarehouse($id){
        $product = Products::find($id);
        $warehouse = Warehouse::where('status','=','active')->get();
        $warehouse1 = Warehouse::where('status','=','active')->get();
        return view('admin2.chuyen_san_pham_giua_cac_kho',compact('product','warehouse','warehouse1'));
    }

    public function actionWarehouseToWarehouse(Request $request){

        $validator = \Validator::make($request->all(),[
            'txtWarehouseFrom' => 'required',
            'txtWarehouseTo' => 'required',
            'txtTotalWarehouse' => 'required',
            'txtDate' => 'required',
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        if($request['txtWarehouseFrom'] == $request['txtWarehouseTo']){
            $notification= array(
                'message' => ' Cần nhập kho khác nhau để chuyển sản phẩm!',
                'alert-type' => 'error'
            );
            return Redirect::back()
                ->with($notification)
                ->withInput();
        }
        if($request['txtTotalWarehouse'] < $request['txtTotalExport']){
            $notification= array(
                'message' => ' Số lượng chuyển không được lớn hơn số lượng tồn!',
                'alert-type' => 'error'
            );
            return Redirect::back()
                ->with($notification)
                ->withInput();
        }
        try{
                $create_pdu = DB::table('w2w')->insertGetId([
                    'id_product'=>$request['id_product'],
                    'id_warehouse_from'=> $request['txtWarehouseFrom'],
                    'id_warehouse_to' => $request['txtWarehouseTo'],
                    'time'=> $request['txtDate'],
                    'quatity'=>$request['txtTotalExport'],
                    'status'=> 'sendding',
                    'id_action'=> Auth::id(),
                ]);

        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function tiep_nhan_san_pham(){
        $list_w2w = W2W::join('warehouses as w1','w1.id','=','w2w.id_warehouse_from')
                    ->join('warehouses as w2','w2.id','=','w2w.id_warehouse_to')
                    ->join('products','w2w.id_product','=','products.id')
                    ->select('w2w.id','products.id as product_id','products.name','w1.name as name_from','w2.name as name_to','quatity','time')
                    ->where('w2w.status','=','sendding')->get();
        return view('admin2.tiep_nhan_san_pham',compact('list_w2w'));
    }

    public function acceptW2W($id){
        $list_w2w = W2W::join('warehouses as w1','w1.id','=','w2w.id_warehouse_from')
            ->join('warehouses as w2','w2.id','=','w2w.id_warehouse_to')
            ->join('products','w2w.id_product','=','products.id')
            ->select('w2w.id','products.id as id_pdu','products.name','w1.id as id_from','w1.name as name_from1',
                'w2.id as id_to','w2.name as name_to1','quatity','time')
            ->where('w2w.status','=','sendding')
            ->find($id);
        return view('admin2.action_accept-w2w',compact('list_w2w'));
    }

    public function acceptActionW2W(Request $request){
        $date = date("Y-m-d");
        $tablename1 = substr($date,0,4);
        $tablename2 = substr($date,5,2);
        $tablename = 'iep_'.$tablename1.$tablename2;
//        try{
            $id_last_from = DB::table('warehouse_products')
                ->where('id_product','=',$request->id_product)
                ->where('id_warehouse','=',$request->id_WarehouseFrom)
                ->where('time','<',$date)
                ->orderBy('id','desc')
                ->first();
            $id_last_to = DB::table('warehouse_products')
                ->where('id_product','=',$request->id_product)
                ->where('id_warehouse','=',$request->id_WarehouseTo)
                ->where('time','<',$date)
                ->orderBy('id','desc')
                ->first();

            if($id_last_to == null){
                $sub_warehouse_from = DB::table('warehouse_products')->insertGetId([
                    'id_product' => $request->id_product,
                    'id_warehouse' => $request->id_WarehouseFrom,
                    'contract_tc' => '0000',
                    'time' => Carbon::now(),
                    'total' => $id_last_from->total - $request->txtTotalWarehouse,
                    'type' => 'w2w',
                ]);
                $add_warehouse_to = DB::table('warehouse_products')->insertGetId([
                    'id_product' => $request->id_product,
                    'id_warehouse' => $request->id_WarehouseTo,
                    'contract_tc' => '0000',
                    'time' => Carbon::now(),
                    'total' => $request->txtTotalWarehouse,
                    'type' => 'w2w',
                ]);
            }else {
                $sub_warehouse_from = DB::table('warehouse_products')->insertGetId([
                    'id_product' => $request->id_product,
                    'id_warehouse' => $request->id_WarehouseFrom,
                    'contract_tc' => '0000',
                    'time' => Carbon::now(),
                    'total' => $id_last_from->total - $request->txtTotalWarehouse,
                    'type' => 'w2w',
                ]);
                $add_warehouse_to = DB::table('warehouse_products')->insertGetId([
                    'id_product' => $request->id_product,
                    'id_warehouse' => $request->id_WarehouseTo,
                    'contract_tc' => '0000',
                    'time' => Carbon::now(),
                    'total' => $id_last_to->total + $request->txtTotalWarehouse,
                    'type' => 'w2w',
                ]);
            }
            $check = Schema::hasTable($tablename);
            if($check != true){
                $create_table = Schema::create($tablename, function (Blueprint $tables) {
                    $tables->increments('id');
                    $tables->integer('id_product');
                    $tables->integer('id_warehouse');
                    $tables->integer('import_total')->nullable();
                    $tables->integer('export_total')->nullable();
                    $tables->dateTime('time');
                    $tables->integer('total');
                    $tables->string('type')->nullable();
                    $tables->timestamps();
                });
            }
            $sub_warehouse= DB::table($tablename)->insertGetId([
                'id_product'=>$request->id_product,
                'id_warehouse'=> $request->id_WarehouseFrom,
                'export_total' => $request->txtTotalWarehouse,
                'time'=> Carbon::now(),
                'total'=>$request->txtTotalWarehouse,
                'type'=> 'w2w',
            ]);
            $add_warehouse= DB::table($tablename)->insertGetId([
                'id_product'=>$request->id_product,
                'id_warehouse'=> $request->id_WarehouseTo,
                'import_total' => $request->txtTotalWarehouse,
                'time'=> Carbon::now(),
                'total'=>$request->txtTotalWarehouse,
                'type'=> 'w2w',
            ]);
            $update_w2w = DB::table('w2w')
                ->where('id','=',$request->id_w2w)
                ->update([
                    'status'=>'done',
                ]);
//        }
//        catch (QueryException $ex){
//            $notification = array(
//                'message' => 'Thông tin không chính xác! Vui lòng kiểm tra lại ',
//                'alert-type' => 'error'
//            );
//            return Redirect::back()->with($notification);
//        }
        $notification = array(
            'message' => 'Thực hiện thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function indexSaleProduct(){
        $product = Products::all();
        $product_1 = Products::all();
        $product_2 = Products::all();
        $product_3 = Products::all();
        $group = Group::all();
        $gift = Gift::all();
        return view('admin2.sales.index_sale_product',compact('product','product_1','product_2','product_3','group','gift'));
    }

    public function addSaleProduct(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtNameProduct' => 'required',
            'txtName' => 'required',
            'txtQdtc' => 'required',
            'txtGroup' => 'required',
            'txtPrice' => 'required',
            'txtType' => 'required',
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            if($request->txtType == 'giamgia'){
                $create_pdu = DB::table('sales')->insertGetId([
                    'name'=> $request['txtName'],
                    'qdtc' => $request['txtQdtc'],
                    'price_sale'=> $request['txtPrice'],
                    'type'=> $request['txtType'],
                    'sale_off'=> $request['txtPriceSale'],
                    'id_gifts'=> null,
                ]);
            }elseif($request->txtType == 'tangqua'){
                if($request['txtGift_r1'] === 'no_choice' ){
                    $gift = null;
                }else{
                    $gift = $request['txtGift_r1'];
                }

                if($request['txtGift_r2'] === 'no_choice' ){
                    $gift_2 = $gift;
                }else{
                    $gift_2 = $gift.','.$request['txtGift_r2'];
                }

                if($request['txtGift_r3'] === 'no_choice' ){
                    $gift_3 = $gift_2;
                }else{
                    $gift_3 = $gift_2.','.$request['txtGift_r3'];
                }
                $create_pdu = DB::table('sales')->insertGetId([
                    'name'=> $request['txtName'],
                    'qdtc' => $request['txtQdtc'],
                    'price_sale'=> $request['txtPrice'],
                    'type'=> $request['txtType'],
                    'sale_off'=> null,
                    'id_gifts'=> $gift_3,
                ]);
            }else{
                $notification = array(
                    'message' => 'Chọn hình thức khuyến mại và nhập đúng thông tin!',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }

            if(!is_numeric($create_pdu)){
                $notification = array(
                    'message' => 'Kiểm tra lại thông tin khuyến mại ',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }else{
                $insert_saleproduct = DB::table('sales_products')->insert([
                    'id_sales'=>$create_pdu,
                    'id_product'=>$request['txtNameProduct'],
                    'id_group'=>$request['txtGroup'],
                ]);
            }
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function listSaleProduct(){
        $product = Products::all();
        $product_1 = Products::all();
        $product_2 = Products::all();
        $product_3 = Products::all();
        $group = Group::all();
        $gift = Gift::all();
        $list_sale_product = SalesProducts::join('sales','sales.id','=','sales_products.id_sales')
            ->join('products','products.id','=','sales_products.id_product')
            ->join('groups','groups.id','=','sales_products.id_group')
            ->leftJoin('gifts','sales.id_gifts','=','gifts.id')
            ->select('sales.id','sales.name','sales.qdtc','products.name as name_product','products.product_code'
                ,'groups.id as id_group','groups.name as name_group','sales.price_sale as sal_price','sales.type as sale_type','sales.sale_off'
            ,'sales.id_gifts','gifts.name as name_gifts')->get();
        return view('admin2.sales.list_sale_product',compact('list_sale_product','product','product_1','product_2','product_3','group','gift'));
    }

    public function searchSalesProduct($id){
        $product = Products::all();
        $product_1 = Products::all();
        $product_2 = Products::all();
        $product_3 = Products::all();
        $group = Group::all();
        $gift = Gift::all();
        $list = SalesProducts::join('sales','sales.id','=','sales_products.id_sales')
            ->join('products','products.id','=','sales_products.id_product')
            ->join('groups','groups.id','=','sales_products.id_group')
            ->leftJoin('gifts','sales.id_gifts','=','gifts.id')
            ->select('sales.id','sales.name','sales.qdtc','products.name as name_product','products.product_code'
                ,'groups.name as name_group','sales.price_sale as sal_price','sales.type as sale_type','sales.sale_off'
                ,'sales.id_gifts','gifts.name as name_gifts','sales_products.id_product','sales_products.id_group')
            ->where('sales.id','=',$id)->get();
        return view('admin2.sales.edit_sale_product',compact('product','product_1','product_2','product_3','group','gift','list'));
    }

    public function addRewardEmulation(){
        return view('admin2.emulation.create_reward');
    }

    public function insertRewardEmulation(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:250',
            'txtQuatity' => 'required',
            'txtLevel' => 'required',
            'txtValues' => 'required',
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
                $create_reward = DB::table('rewards')->insertGetId([
                    'name'=> $request['txtName'],
                    'quantity' => $request['txtQuatity'],
                    'values'=> $request['txtValues'],
                    'level'=> $request['txtLevel'],
                    'sl_min'=> $request['txtSl_min'],
                    'ds_min'=> $request['txtDs_min'],
                ]);

        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function updateSaleProduct(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtNameProduct' => 'required',
            'txtName' => 'required',
            'txtQdtc' => 'required',
            'txtGroup' => 'required',
            'txtPrice' => 'required',
            'txtType' => 'required',
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            if($request->txtType == 'giamgia'){
                $create_pdu = DB::table('sales')->where('id','=',$request->id_sale)
                    ->update([
                    'name'=> $request['txtName'],
                    'qdtc' => $request['txtQdtc'],
                    'price_sale'=> $request['txtPrice'],
                    'type'=> $request['txtType'],
                    'sale_off'=> $request['txtPriceSale'],
                    'id_gifts'=> null,
                ]);
            }elseif($request->txtType == 'tangqua'){
                if($request['txtGift_r1'] === 'no_choice' ){
                    $gift = null;
                }else{
                    $gift = $request['txtGift_r1'];
                }

                if($request['txtGift_r2'] === 'no_choice' ){
                    $gift_2 = $gift;
                }else{
                    $gift_2 = $gift.','.$request['txtGift_r2'];
                }

                if($request['txtGift_r3'] === 'no_choice' ){
                    $gift_3 = $gift_2;
                }else{
                    $gift_3 = $gift_2.','.$request['txtGift_r3'];
                }
                $create_pdu = DB::table('sales')->where('id','=',$request->id_sale)
                    ->update([
                    'name'=> $request['txtName'],
                    'qdtc' => $request['txtQdtc'],
                    'price_sale'=> $request['txtPrice'],
                    'type'=> $request['txtType'],
                    'sale_off'=> null,
                    'id_gifts'=> $gift_3,
                ]);
            }else{
                $notification = array(
                    'message' => 'Chọn hình thức khuyến mại và nhập đúng thông tin!',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }

            if(!is_numeric($create_pdu)){
                $notification = array(
                    'message' => 'Kiểm tra lại thông tin khuyến mại ',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }else{
                $id_spd = SalesProducts::where('id_sales','=',$request->id_sale)
                    ->where('id_product','=',$request->id_pdu)
                    ->where('id_group','=',$request->id_grp)->get();
                foreach ($id_spd as $value) {
                    $insert_saleproduct = DB::table('sales_products')
                        ->where('id','=',$value->id)
                        ->update([
                        'id_sales' => $request['id_sale'],
                        'id_product' => $request['txtNameProduct'],
                        'id_group' => $request['txtGroup'],
                    ]);
                }
            }
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function indexEmulationProduct(){
        $reward = Reward::all();
        return view('admin2.emulation.index_emulation_product',compact('reward'));
    }

    public function addEmulationProduct(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required',
            'txtQdtc' => 'required',
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
                $create_pdu = DB::table('emulations')->insertGetId([
                    'name'=> $request['txtName'],
                    'qdtc' => $request['txtQdtc'],
                    'total'=> $request['txtSl_min'],
                    'revenue'=> $request['txtDs_min'],
                ]);

            if(!is_numeric($create_pdu)){
                $notification = array(
                    'message' => 'Kiểm tra lại thông tin thi đua ',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }else{
                $str_reward = '';
                foreach ($request['txtReward'] as $value){
                    $str_reward = $str_reward.','.$value;
                }
                $rs_str_reward = substr($str_reward,1,strlen($str_reward)-1);
                $insert_emulation_product = DB::table('emulation_products')->insert([
                    'id_emulation'=>$create_pdu,
                    'id_reward'=>$rs_str_reward,
                ]);
            }
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function listEmulationProduct(){
        $reward = Reward::all();
        $emulation = Emulation::join('emulation_products','emulations.id','=','emulation_products.id_emulation')
//            ->join('rewards','rewards.id','=','emulation_products.id_reward')
            ->select('emulation_products.id','emulations.name','emulations.qdtc','emulation_products.id_product',
                'emulations.total','emulations.revenue','emulation_products.id_reward')
            ->get();
        return view('admin2.emulation.list_emulation_product',compact('emulation','reward'));
    }

    public function editInformationEmulation($id){
        $emula = Emulation::join('emulation_products','emulation_products.id_emulation','=','emulations.id')
             -> where('emulation_products.id','=',$id)->get();
        $gift = Reward::all();
        return view('admin2.emulation.update_infor_emulation',compact('emula','gift'));
    }

    public function updateInformationProductEmulation(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required',
            'txtQdtc' => 'required',
            'txtReward'=> 'required'
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
                $update_product = DB::table('emulations')
                    ->where('id', '=', $request->id_emulation)
                    ->update([
                        'name'=> $request['txtName'],
                        'qdtc' => $request['txtQdtc'],
                        'total'=> $request['txtSl_min'],
                        'revenue'=> $request['txtDs_min'],
                    ]);
            $str_reward = '';

            foreach ($request['txtReward'] as $value){
                $str_reward = $str_reward.','.$value;
            }
            $rs_str_reward = substr($str_reward,1,strlen($str_reward)-1);
                $update_eml_pdu = DB::table('emulation_products')
                    ->where('id', '=', $request->id_emulation_pdu)
                    ->update([
                        'id_reward'=> $rs_str_reward,
                    ]);
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function addProductToEmulation($id){
        $product = Products::all();
        $supplier = Supplier::all();
        $list_id_product = EmulationProducts::find($id);
        $arr = explode(',',$list_id_product->id_product);
        return view('admin2.emulation.list_product_add_emulation',compact('product','supplier','id','arr'));
    }

    public function updateAddProductEmulation(Request $request){
        $arr = $request->toArray();
        $arr_id_group = explode('_',$request->id_emulation_product);
        $id_goal_product = $arr_id_group[0];
        $arr_id = '';
        foreach ($arr as $value){
            if(is_numeric($value)){
                $arr_id .= ','.$value;
            }
        }
        try {
            if (strlen($arr_id) == 0) {
                $update_w2w = DB::table('emulation_products')
                    ->where('id', '=', $id_goal_product)
                    ->update([
                        'id_product' => null,
                    ]);
                $id_total_product = TotalProductEmulation::where('id_emu_pdu','=',$id_goal_product)->get();
                foreach ($id_total_product as $value){
                    $delete_total = TotalProductEmulation::destroy($value->id);
                }
            } else {
                $update_w2w = DB::table('emulation_products')
                    ->where('id', '=',  $id_goal_product)
                    ->update([
                        'id_product' => substr($arr_id, 1),
                    ]);
                $id_total_product = TotalProductEmulation::where('id_emu_pdu','=',$id_goal_product)->get();
                foreach ($id_total_product as $value){
                    $delete_total = TotalProductEmulation::destroy($value->id);
                }
                foreach ($arr as $values){
                    if(is_numeric($values)){
                        $insert_total_product = DB::table('total_product_emulations')->insert([
                           'id_emu_pdu'=>$id_goal_product,
                            'id_product'=>$values,
                            'total' => 0,
                            'revenue' => 0,
                        ]);
                    }
                }
            }
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Thêm sản phẩm lỗi, kiểm tra lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Thực hiện thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function listProductDetailEmulation($id){
        $emu_product = EmulationProducts::find($id);
        $arr_id_product = explode(',',$emu_product->id_product);
        $total_product = TotalProductEmulation::
            join('products','products.id','=','total_product_emulations.id_product')
            ->where('id_emu_pdu','=',$id)
            ->whereIn('id_product',$arr_id_product)
            ->get();
        return view('admin2.emulation.list_detail_product_emulation',compact('total_product','id'));
    }

    public function updateTotalProductEmulation($id,$id_emu){
        $product_emulation = TotalProductEmulation::
            join('products','products.id','=','total_product_emulations.id_product')
            ->where('id_emu_pdu','=',$id_emu)
            ->where('id_product','=',$id)
            ->get();
        $id_total_product_emulation = TotalProductEmulation::
            join('products','products.id','=','total_product_emulations.id_product')
            ->addSelect('total_product_emulations.id as id_tt')
            ->where('id_emu_pdu','=',$id_emu)
            ->where('id_product','=',$id)
            ->get();
        $x = 0;
        foreach ($id_total_product_emulation as $value){
            $x = $value;
        }
        return view('admin2.emulation.edit_total_product_emulation',compact('product_emulation','x'));
    }

    public function edit_total_product_emulation(Request $request){
//        $validator = \Validator::make($request->all(),[
//            'txtTotal' => 'required',
//            'txtRevenue' => 'required',
//        ]);
//        $notification= array(
//            'message' => ' Nhập Số lượng Sản Phẩm!',
//            'alert-type' => 'error'
//        );
//        if ($validator ->fails()) {
//            return Redirect::back()
//                ->with($notification)
//                ->withErrors($validator)
//                ->withInput();
//        }
        try{
                $update_product = DB::table('total_product_emulations')
                    ->where('id', '=', $request->id_emulation_pdu)
                    ->update([
                        'total'=> $request->txtTotal,
                        'revenue'=> $request->txtRevenue,
                    ]);

        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Cập Nhật không thành công! Vui lòng nhập lại ',
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

    public function indexGoalProduct (){
        return view('admin2.goal.index_goal_product');
    }

    public function addGoalProduct(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required',
            'txtType' => 'required',
            'txtGoal' => 'required',
            'txtStart' => 'required',
            'txtEnd' => 'required',
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            if($request->txtType == 'sanluong'){
                $create_pdu = DB::table('goal_products')->insertGetId([
                    'name'=> $request['txtName'],
                    'type'=> $request['txtType'],
                    'sl'=> $request['txtGoal'],
                    'dt'=> null,
                    'start_time'=> $request['txtStart'],
                    'end_time'=> $request['txtEnd'],
                ]);
            }elseif($request->txtType == 'doanhthu'){
                $create_pdu = DB::table('goal_products')->insertGetId([
                    'name'=> $request['txtName'],
                    'type'=> $request['txtType'],
                    'sl'=> null,
                    'dt'=> $request['txtGoal'],
                    'start_time'=> $request['txtStart'],
                    'end_time'=> $request['txtEnd'],
                ]);
            }else{
                $notification = array(
                    'message' => 'Chọn loại mục tiêu và kiểm tra thông tin!',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }

            if(!is_numeric($create_pdu)){
                $notification = array(
                    'message' => 'Kiểm tra lại thông tin ',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }else{
                $insert_emulation_product = DB::table('goal_sales')->insert([
                    'id_goal'=>$create_pdu,
                    'id_product'=>null,
                    'id_group'=>null,
                ]);
            }
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function listGoalProduct(){
        $goal_product = GoalSales::join('goal_products','goal_products.id','=','goal_sales.id_goal')
            ->select('goal_sales.id','goal_sales.id_product','goal_sales.id_group','goal_products.name'
                ,'goal_products.type','goal_products.sl','goal_products.dt',
            'goal_products.start_time','goal_products.end_time')->get();
        return view('admin2.goal.list_goal_product',compact('goal_product'));
    }

    public function addProductToGoal($id){
        $product = Products::all();
        $supplier = Supplier::all();
        $list_goal_sales = GoalSales::find($id);
        $arr = explode(',',$list_goal_sales->id_product);
        return view('admin2.goal.list_product_add_goal',compact('product','supplier','id','arr'));
    }

    public function addAsmToGoal($id){
        $asm_result = Group::all();
        $supplier = Supplier::all();
        $list_goal_sales = GoalSales::find($id);
        $arr = explode(',',$list_goal_sales->id_group);
        return view('admin2.goal.list_asm_add_goal',compact('asm_result','supplier','id','arr'));
    }

    public function updateAddProductGoal(Request $request){
        $arr = $request->toArray();
        $arr_id_group = explode('_',$request->id_emulation_product);
        $id_goal_product = $arr_id_group[0];
        $arr_id = '';
        foreach ($arr as $value){
            if(is_numeric($value)){
                $arr_id .= ','.$value;
            }
        }
        try {
            if (strlen($arr_id) == 0) {
                $update_w2w = DB::table('goal_sales')
                    ->where('id', '=', $id_goal_product)
                    ->update([
                        'id_product' => null,
                    ]);
            } else {
                $update_w2w = DB::table('goal_sales')
                    ->where('id', '=',  $id_goal_product)
                    ->update([
                        'id_product' => substr($arr_id, 1),
                    ]);
            }
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Thêm sản phẩm lỗi, kiểm tra lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Thực hiện thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function updateAddAsmGoal(Request $request){
        $arr = $request->toArray();
        $arr_id_group = explode('_',$request->id_emulation_product);
        $id_goal_product = $arr_id_group[0];
        $arr_id = '';
        foreach ($arr as $value){
            if(is_numeric($value)){
                $arr_id .= ','.$value;
            }
        }
        try {
            if (strlen($arr_id) == 0) {
                $update_w2w = DB::table('goal_sales')
                    ->where('id', '=', $id_goal_product)
                    ->update([
                        'id_group' => null,
                    ]);
            } else {
                $update_w2w = DB::table('goal_sales')
                    ->where('id', '=',  $id_goal_product)
                    ->update([
                        'id_group' => substr($arr_id, 1),
                    ]);
            }
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Thêm sản phẩm lỗi, kiểm tra lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Thực hiện thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }

    public function viewUpdateInformationGoal($id){
        $goal_product = GoalProduct::find($id);
        return view('admin2.goal.update_information_goal',compact('goal_product'));
    }

    public function updateInformationGoal(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required',
            'txtType' => 'required',
            'txtGoal' => 'required',
            'txtStart' => 'required',
            'txtEnd' => 'required',
        ]);
        $notification= array(
            'message' => ' Nhập thông tin lỗi! Hãy kiểm tra lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            if($request->txtType == 'sanluong'){
                $create_pdu = DB::table('goal_products')
                    ->where('id','=',$request['id_goal'])
                    ->update([
                    'name'=> $request['txtName'],
                    'type'=> $request['txtType'],
                    'sl'=> $request['txtGoal'],
                    'dt'=> null,
                    'start_time'=> $request['txtStart'],
                    'end_time'=> $request['txtEnd'],
                ]);
            }elseif($request->txtType == 'doanhthu'){
                $create_pdu = DB::table('goal_products')
                    ->where('id','=',$request['id_goal'])
                    ->update([
                    'name'=> $request['txtName'],
                    'type'=> $request['txtType'],
                    'sl'=> null,
                    'dt'=> $request['txtGoal'],
                    'start_time'=> $request['txtStart'],
                    'end_time'=> $request['txtEnd'],
                ]);
            }else{
                $notification = array(
                    'message' => 'Chọn loại mục tiêu và kiểm tra thông tin!',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
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

    public function listHoanUng(){
        $curDate = date("Y-m-d");
        $table = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        $list_hoan_ung = DB::table($table)
            ->join('products','id_product','=','products.id')
            ->join('users','id_user','=','users.id')
//            ->where('status_transport','=','done')
//            ->where('status_payment','=','done')
//            ->where('status_kt','=','done')
//            ->where('status_admin2','=','wait')
            ->select(''.$table.'.*','products.*')
            ->addSelect(''.$table.'.id as id_order')
            ->addSelect('users.last_name')
            ->addSelect('users.email')
            ->get();
        $product = Products::all();
        return view('admin2.hoan_ung.list_hoan_ung',compact('list_hoan_ung','product'));
    }

    public function view_detail_hoan_ung($id){
        $curDate = date("Y-m-d");
        $table = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        $order_hoan_ung = DB::table($table)->find($id);
        $product = Products::find($order_hoan_ung->id_product);
        return view('admin2.hoan_ung.detail_order_hoan_ung',compact('order_hoan_ung','product'));
    }

    public function action_update_hoan_ung_admin2(Request $request){
        $id_order = $request->id_hoan_ung;
        $curDate = date("Y-m-d");
        $table1 = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        try {
            $update_hoan_ung = DB::table($table1)->where('id','=',$id_order)
                ->update([
                    'status_admin2'=>'done',
                ]);
            if($update_hoan_ung == 0){
                $notification = array(
                    'message' => 'Kiểm tra lại thông tin hoàn ứng!',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }else{
                $id_user = DB::table($table1)->find($id_order);
                $han_muc_now = DB::table('users')->find($id_user->id_user)->han_muc;
                $update_hoan_ung_user = DB::table('users')
                    ->where('id','=',$id_user->id_user)
                    ->update([
                        'han_muc'=>$han_muc_now + $request->txtTotalPrice,
                    ]);
            }
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Kiểm tra lại thông tin hoàn ứng!',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Hoàn ứng thành công !',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }
}
