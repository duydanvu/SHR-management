<?php

namespace App\Http\Controllers;

use App\Position;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $position = DB::table('positions')
            ->select('positions.*')
            ->addSelect(DB::raw("'0' as sum_user"))
            ->get();
        $position_admin = User::where('position_id','=',1)->get();
        $position_sm = User::where('position_id','=',2)->get();
        $position_staff = User::where('position_id','=',3)->get();
        foreach ($position as $value){
            if($value->position_id == 1){
                $value->sum_user = count($position_admin);
            }elseif ($value->position_id == 2){
                $value->sum_user = count($position_sm);
            }elseif ($value->position_id == 3){
                $value->sum_user = count($position_staff);
            }
        }
        return view('position.position_list')->with(['position'=>$position]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtDescription' => 'required|max:250'
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
            $create_area = DB::table('positions')->insert([
                'position_name'=> $request['txtName'],
                'description' => $request['txtDescription']
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = Position::find($id);
        return  view('position.position_update')->with(['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'txtName'=> 'required|max:100',
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
        $data_area_update =DB::table('positions')->where('position_id','=',$request->position_id)
            ->update([
                'position_name'=>$request->txtName,
                'description'=>$request->txtDescription

            ]);
        if($data_area_update = true){
            $notification = array(
                'message' => 'Cập nhật  thông tin thành công!',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $data = Position::find($id)
            ->delete();
        if($data = true){
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
