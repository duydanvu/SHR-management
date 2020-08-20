<?php

namespace App\Http\Controllers;

use App\Area;
use App\Contract;
use App\Department;
use App\Position;
use App\Services;
use App\Store;
use App\User;
use App\UserDetail;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $store = Store::all();
        $position = Position::all();
        $contract = Contract::all();
        $department = Department::all();
        $service = Services::all();
        $area = Area::all();
        $user = User::join('stores','users.store_id','=','stores.store_id')
            ->join('positions','users.position_id','=','positions.position_id')
            ->join('contracts','users.contract_id','=','contracts.contract_id')
            ->join('departments','users.department_id','=','departments.id')
            ->join('services','users.service_id','=','services.id')
            ->select('users.*','stores.store_name','positions.position_name','contracts.name as ct_name','departments.name as dp_name','services.name as sv_name')
            ->get();
        return view('user.users_list')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'area' => $area]);
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
//        dd($request['url_image']);
        if($request['url_image'] == null){
            $notification_img= array(
                'message' => ' Đăng ký lỗi! Hãy chọn ảnh cho tài khoản!',
                'alert-type' => 'error'
            );
            return Redirect::back()
                ->with($notification_img)
                ->withInput();
        }
        $validator = \Validator::make($request->all(),[
            'txtName' => 'required|max:50',
            'txtPassword' => 'required|min:7|max:100',
            'txtFName' => 'required|max:50',
            'txtLName' => 'required|max:50',
            'txtEmail' => 'required|max:100|email',
            'txtPhone' => 'required|integer',
            'txtDob'   => 'required|date',
            'txtLine'  => 'required|max:50',
            'txtNContract' => 'required|max:50',
            'txtGender' => 'required|max:6',
            'store'=> 'required|integer',
            'position'=> 'required|integer',
            'contract'=> 'required|integer',
            'department'=> 'required|integer',
            'service'=> 'required|integer',
            'txtStart'=> 'required|date',
            'txtEnd'=> 'required|date',
            'txtIdentity'=>'required|integer',
            'txtIdndate'=>'required',
            'txtTIN'=>'integer',
            'txtIdnAdd'=>'required',
            'txtAddr_Now'=>'min:4',
            'txtNssc'=>'integer',
            'txtHospital'=>'max:50',
            'txtBan'=> 'integer',
            'txtBank' => 'max:50',
            'txtAdd_Noi' => 'min:4'
        ]);
        $notification= array(
            'message' => ' Đăng ký lỗi! Hãy chọn phần tạo tài khoản và nhập lại thông tin!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $create_user_id = DB::table('users')->insertGetId([
                'login'=> $request['txtName'],
                'password' => $request['txtPassword'],
                'first_name' => $request['txtFName'],
                'last_name' => $request['txtLName'],
                'email' => $request['txtEmail'],
                'phone' => $request['txtPhone'],
                'dob' => $request['txtDob'],
                'address' => '',
                'gender' => $request['txtGender'],
                'url_image' => $request['url_image'],
                'line' => $request['txtLine'],
                'store_id' => $request['store'],
                'department_id' => $request['department'],
                'service_id' => $request['service'],
                'position_id' => $request['position'],
                'contract_id' => $request['contract'],
                'contract_number' => $request['txtNContract'],
                'start_time' => $request['txtStart'],
                'end_time' => $request['txtEnd'],
            ]);
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng nhập lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        try{
            $create_user_detail = DB::table('user_details')->insert([
                'id_user'=> $create_user_id,
                'identity_number'=> $request['txtIdentity'],
                'tin'=> $request['txtTIN'],
                'idn_date'=> $request['txtIdndate'],
                'idn_address'=> $request['txtIdnAdd'],
                'ssc_number'=> $request['txtNssc'],
                'hospital'=> $request['txtHospital'],
                'ban'=> $request['txtBan'],
                'bank'=> $request['txtBank'],
                'noi_address'=> $request['txtAdd_Noi'],
                'address_now'=> $request['txtAddr_Now'],
            ]);
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin Chi tiết không chính xác! Vui lòng nhập lại ',
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

    public function viewUpdate($id){
        $store = Store::all();
        $position = Position::all();
        $contract = Contract::all();
        $department = Department::all();
        $service = Services::all();
        $area = Area::all();
        $user = User::join('stores','users.store_id','=','stores.store_id')
            ->join('positions','users.position_id','=','positions.position_id')
            ->join('contracts','users.contract_id','=','contracts.contract_id')
            ->join('departments','users.department_id','=','departments.id')
            ->join('services','users.service_id','=','services.id')
            ->select('users.*','stores.store_name','positions.position_name','contracts.name as ct_name','departments.name as dp_name','services.name as sv_name')
            ->find($id);
        return view('user.user_update')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'area' => $area]);
    }

    public function edit_detail($id){
        $user_detail = UserDetail::find($id);
        return view('user.user_update_detail')->with(['user_detail'=>$user_detail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
