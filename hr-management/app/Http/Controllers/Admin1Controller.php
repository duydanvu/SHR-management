<?php

namespace App\Http\Controllers;

use App\User;
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
                'tpye' => 'systems'
            ]);
            for($i = 2; $i <7;$i++) {
                $insert_user_action = DB::table('user_action')->insert([
                    'user_id' => $create_area,
                    'action_id' => $i,
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
            $update_user = DB::table('users')->where('id','=',$request->id_user)
                ->update([
                    'login'=>$request->txtName,
                    'last_name'=>$request->txtLName,
                    'email'=> $request->txtEmail,
                    'phone'=> $request->txtPhone,
                    'dob'=> $request->txtDob,
                ]);
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
}