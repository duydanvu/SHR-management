<?php

namespace App\Http\Controllers;

use App\Area;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AreaController extends Controller
{
    public function listArea(){
        $area = Area::all();
        return view('area.area_list',compact('area'));
    }

    public function addNewArea(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtDescription' => 'required|max:250',
        ]);
        $noti= array(
            'message' => ' Đăng ký lỗi! Hãy chọn phần tạo tài khoản và nhập lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator->fails()) {
            return Redirect::back()
                ->with($noti)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $create_area = DB::table('area')->insert([
                'area_name'=> $request['txtName'],
                'area_description' => $request['txtDescription']
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

    public function viewUpdateArea($id){
        $data = Area::find($id);
        return view('area.view_area_update')->with('data',$data);
    }

    public function updateInforArea(Request $request){
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtDescription' => 'required|max:250',
        ]);
        $noti= array(
            'message' => ' Cập nhật lỗi! Hãy kiểm tra lại thông tin tài khoản và nhập lại !',
            'alert-type' => 'error'
        );
        if ($validator->fails()) {
            return Redirect::back()
                ->with($noti)
                ->withErrors($validator)
                ->withInput();
        }
        $data_area_update =DB::table('area')->where('id','=',$request->area_id)
            ->update([
                'area_name'=>$request->txtName,
                'area_description'=>$request->txtDescription
            ]);
        if($data_area_update = 1){
            $notification = array(
                'message' => 'Cập nhật thông tin thành công!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Cập nhật thông tin không thành công!',
                'alert-type' => 'success'
            );
        }
        return Redirect::back()->with($notification);
    }

    public function deleteArea($id){
        $update_store = DB::table('stores')->select('store_id')
            ->where('area_id','=',$id)
            ->get();
        foreach ($update_store as $value){
            $update_id_area = DB::table('stores')->where('store_id','=',$value->store_id)
                ->update(['area_id'=>1]);
        }
        $data = DB::table('area')
            ->delete($id);
        if($data = 1){
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
