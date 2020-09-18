<?php

namespace App\Http\Controllers;

use App\User;
use App\Warehouse;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Admin1Controller extends Controller
{
    public function index(){
        $user = User::join('user_action','users.id','=','user_action.user_id')
            ->select('users.id','users.last_name','users.email','users.dob','users.phone',DB::raw('COUNT(user_action.user_id) as sum_action'))
            ->groupBy('users.id','users.last_name','users.email','users.dob','users.phone')
            ->get();
        $list_admin_lv2 = collect([]);
        foreach ($user as $value){
            if($value->sum_action == 5){
                $list_admin_lv2 -> push(
                    [
                        "id"=>$value->id,
                        "last_name" => $value->last_name,
                        "email" => $value->email,
                        "dob" => $value->dob,
                        "phone" => $value->phone,
                    ]
                );
            }
        }
        return view('admin1.create_acc')->with(['user'=>$list_admin_lv2]);
    }

    public function search_ajax_admin_lv2(Request $request){
        $user = User::join('user_action','users.id','=','user_action.user_id')
            ->select('users.id','users.last_name','users.email','users.dob','users.phone',DB::raw('COUNT(user_action.user_id) as sum_action'))
            ->where('users.last_name','like','%'.$request->name_user.'%')
            ->groupBy('users.id','users.last_name','users.email','users.dob','users.phone')
            ->get();
        $result = null;
        foreach ($user as $key => $value){
            if ($value->sum_action == 5){
                $result .= '<tr>';
                $result .= '<td>'.($key+1).'</td>';
                $result .= '<td class="text-center">
                                <a href="'.route('search_view_update_admin_lv2',['id'=>$value['id']]).'" data-remote="false"
                                   data-toggle="modal" data-target="#modal-admin-action-update" class="btn dropdown-item">
                                    <i class="fas fa-edit"> Sửa</i>
                                </a>
                            </td>';
                $result .= '<td>'.($value->last_name).'</td>';
                $result .= '<td>'.($value->email).'</td>';
                $result .= '<td>'.($value->dob).'</td>';
                $result .= '<td>'.($value->phone).'</td>';
                $result .= '</tr>';
            }
        }
        return $result;
    }

    public function add_account_user(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtPassword' => 'required|max:250',
            'txtLName'=> 'required|max:50',
            'txtEmail' => 'required|email',
            'txtPhone' => 'required',
            'txtDob' => 'required',
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
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $create_area = DB::table('users')->insertGetId([
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
                'type' => 'systems'
            ]);
            $insert_log_create = DB::table('action_logs')->insert([
               'id_action'=> \Auth::id(),
                'id_affecct'=> $create_area,
                'content'=>'create account admin2',
                'time'=> date("Y-m-d H:i:s"),
            ]);
            for($i = 2; $i <7;$i++) {
                $insert_user_action = DB::table('user_action')->insert([
                    'user_id' => $create_area,
                    'action_id' => $i,
                ]);
                $insert_log_create = DB::table('action_logs')->insert([
                    'id_action'=> \Auth::id(),
                    'id_affecct'=> $create_area,
                    'content'=>'add action for admin2',
                    'time'=> date("Y-m-d H:i:s"),
                ]);
            }
        }
        catch (QueryException $ex){
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
            'txtPassword' => 'required',
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
            if ($request->txtPassword == '01635741662') {
                $update_user = DB::table('users')->where('id', '=', $request->id_user)
                    ->update([
                        'login' => $request->txtName,
                        'last_name' => $request->txtLName,
                        'email' => $request->txtEmail,
                        'phone' => $request->txtPhone,
                        'dob' => $request->txtDob,
                    ]);
                $insert_log_create = DB::table('action_logs')->insert([
                    'id_action'=> \Auth::id(),
                    'id_affecct'=> $request->id_user,
                    'content'=>'update account for admin2',
                    'time'=> date("Y-m-d H:i:s"),
                    ]);
            }else{
                $update_user = DB::table('users')->where('id', '=', $request->id_user)
                    ->update([
                        'login' => $request->txtName,
                        'last_name' => $request->txtLName,
                        'email' => $request->txtEmail,
                        'phone' => $request->txtPhone,
                        'dob' => $request->txtDob,
                        'password' => \Hash::make($request->txtPassword),
                    ]);
            }
        }catch (QueryException $ex){
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

    public function search_user_update($id){
        $user = User::find($id);
        return view('admin1.update_infor_user')->with(['user'=> $user]);
    }

    public function delete_admin_lv2($id){
        $data = User::find($id)
            ->delete();
        if($data == true ){
            $notification = array(
                'message' => 'Xoá thông tin thành công!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Xóa thông tin không thành công!',
                'alert-type' => 'success'
            );
        }
        return Redirect::back()->with($notification);
    }

    public function index_warehouse(){
        $wh = Warehouse::all();
        return view('admin1.index_warehouse',compact('wh'));
    }

    public function addWarehouse(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtAddress' => 'required|max:250',
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
            $create_wh = DB::table('warehouses')->insertGetId([
                'name'=> $request['txtName'],
                'address' => $request['txtAddress'],
            ]);
            $warehouse_code = 'WH_'.$create_wh;
            $update_user = DB::table('warehouses')->where('id', '=', $create_wh)
                ->update([
                    'warehouse_code' => $warehouse_code,
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

    public function searchWarehouse($id){
        $wh = Warehouse::find($id);
        return view('admin1.update_infor_warehouse',compact('wh'));
    }

    public function updateWarehouse(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtAddress' => 'required|max:250',
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
            $update_user = DB::table('warehouses')->where('id', '=', $request->id_wh)
                ->update([
                    'name' => $request->txtName,
                    'address' => $request->txtAddress,
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

    public function index_connect_landing_page(){
        return view('admin1.list_products');
    }

    public function index_connect_doi_tac(){
        return view('admin1.list_products_connect_doi_tac');
    }
}
