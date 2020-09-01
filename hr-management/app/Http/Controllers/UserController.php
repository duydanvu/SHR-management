<?php

namespace App\Http\Controllers;

use App\Area;
use App\Contract;
use App\Department;
use App\Imports\UsersImport;
use App\Position;
use App\Services;
use App\Store;
use App\User;
use App\UserDetail;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

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
        $store1 = Store::all();
        $position1 = Position::all();
        $contract1 = Contract::all();
        $department1 = Department::all();
        $service1 = Services::all();
        $area = Area::all();
        $user = User::join('stores','users.store_id','=','stores.store_id')
            ->join('positions','users.position_id','=','positions.position_id')
            ->join('contracts','users.contract_id','=','contracts.contract_id')
            ->join('departments','users.department_id','=','departments.id')
            ->join('services','users.service_id','=','services.id')
            ->select('users.*','stores.store_name','positions.position_name','contracts.name as ct_name','departments.name as dp_name','services.name as sv_name')
//            ->get()
            ->paginate(25);
        return view('user.users_list')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'store1'=>$store1,
            'position1'=>$position1,
            'contract1'=>$contract1,
            'department1'=>$department1,
            'service1' =>$service1,
            'area' => $area]);
    }

    public function view_user_of_store($id){
        $store = Store::all();
        $position = Position::all();
        $contract = Contract::all();
        $department = Department::all();
        $service = Services::all();
        $store1 = Store::all();
        $position1 = Position::all();
        $contract1 = Contract::all();
        $department1 = Department::all();
        $service1 = Services::all();
        $area = Area::all();
        $user = User::join('stores','users.store_id','=','stores.store_id')
            ->join('positions','users.position_id','=','positions.position_id')
            ->join('contracts','users.contract_id','=','contracts.contract_id')
            ->join('departments','users.department_id','=','departments.id')
            ->join('services','users.service_id','=','services.id')
            ->select('users.*','stores.store_name','positions.position_name','contracts.name as ct_name','departments.name as dp_name','services.name as sv_name')
            ->where('stores.store_id','=',$id)
            ->get();
        $store_name = Store::find($id)->store_name;
        return view('user.user_of_store')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'store_name'=>'Store - '.$store_name,
            'store1'=>$store1,
            'position1'=>$position1,
            'contract1'=>$contract1,
            'department1'=>$department1,
            'service1' =>$service1,
            'area' => $area]);
    }
    public function view_user_of_position($id){
        $store = Store::all();
        $position = Position::all();
        $contract = Contract::all();
        $department = Department::all();
        $service = Services::all();
        $store1 = Store::all();
        $position1 = Position::all();
        $contract1 = Contract::all();
        $department1 = Department::all();
        $service1 = Services::all();
        $area = Area::all();
        $user = User::join('stores','users.store_id','=','stores.store_id')
            ->join('positions','users.position_id','=','positions.position_id')
            ->join('contracts','users.contract_id','=','contracts.contract_id')
            ->join('departments','users.department_id','=','departments.id')
            ->join('services','users.service_id','=','services.id')
            ->select('users.*','stores.store_name','positions.position_name','contracts.name as ct_name','departments.name as dp_name','services.name as sv_name')
            ->where('positions.position_id','=',$id)
            ->get();
        $store_name = Position::find($id)->position_name;
        return view('user.user_of_store')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'store_name'=>'Position - '.$store_name,
            'store1'=>$store1,
            'position1'=>$position1,
            'contract1'=>$contract1,
            'department1'=>$department1,
            'service1' =>$service1,
            'area' => $area]);
    }
    public function view_user_of_contract($id){
        $store = Store::all();
        $position = Position::all();
        $contract = Contract::all();
        $department = Department::all();
        $service = Services::all();
        $store1 = Store::all();
        $position1 = Position::all();
        $contract1 = Contract::all();
        $department1 = Department::all();
        $service1 = Services::all();
        $area = Area::all();
        $user = User::join('stores','users.store_id','=','stores.store_id')
            ->join('positions','users.position_id','=','positions.position_id')
            ->join('contracts','users.contract_id','=','contracts.contract_id')
            ->join('departments','users.department_id','=','departments.id')
            ->join('services','users.service_id','=','services.id')
            ->select('users.*','stores.store_name','positions.position_name','contracts.name as ct_name','departments.name as dp_name','services.name as sv_name')
            ->where('contracts.contract_id','=',$id)
            ->get();
        $store_name = Contract::find($id)->position_name;
        return view('user.user_of_store')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'store_name'=>'Contract - '.$store_name,
            'store1'=>$store1,
            'position1'=>$position1,
            'contract1'=>$contract1,
            'department1'=>$department1,
            'service1' =>$service1,
            'area' => $area]);
    }

    public function search_user_with_store(Request $request){
        $result = null;
        $user = User::join('stores','users.store_id','=','stores.store_id')
            ->join('positions','users.position_id','=','positions.position_id')
            ->join('contracts','users.contract_id','=','contracts.contract_id')
            ->join('departments','users.department_id','=','departments.id')
            ->join('services','users.service_id','=','services.id')
            ->select('users.*','stores.store_name','positions.position_name','contracts.name as ct_name','departments.name as dp_name','services.name as sv_name')
            ->where('users.store_id','=',$request->store_search)
            ->paginate(25);
        foreach ($user as $key=>$value){
            $result .= '<tr>';
            $result .= '<td>'.($key+1).'</td>';
            $result .= '<td>'.($value->first_name).' '.($value->last_name).'</td>';
            $result .= '<td>'.(str_replace('@','@ ',$value->email)).'</td>';
            $result .= '<td>'.(str_replace("/","-",$value->phone)).'</td>';
            $result .= '<td>'.($value->dob).'</td>';
            $result .= '<td>'.($value->gender).'</td>';
//            $result .= '<td>'.($value->line).'</td>';
            $result .= '<td>'.($value->store_name).'</td>';
            $result .= '<td>'.($value->position_name).'</td>';
            $result .= '<td>'.($value->dp_name).'</td>';
            $result .= '<td>'.($value->sv_name).'</td>';
            $result .= '<td>'.($value->ct_name).'</td>';
            $result .= '<td>'.($value->start_time).'</td>';
            $result .= '<td>'.($value->end_time).'</td>';
            $result .= '<td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a href="'.route('view_update_user',['id'=>$value->id]).'" data-remote="false"
                                               data-toggle="modal" data-target="#modal-admin-action-update" class="btn dropdown-item">
                                                <i class="fas fa-edit"> Edit</i>
                                            </a>
                                            <a href="'.route('delete_information_user',['id'=>$value->id]).'"  class="btn dropdown-item">
                                                <i class="fas fa-users"> Delete</i>
                                            </a>
                                            <a href="'.route('view_update_user_detail',['id'=>$value->id]).'" data-remote="false"
                                               data-toggle="modal" data-target="#modal-admin-action-update-detail" class="btn dropdown-item">
                                                <i class="fas fa-info-circle"> View detail</i>
                                            </a>
                                            <a href="'.route('view_update_user_image',['id'=>$value->id]).'" data-remote="false"
                                               data-toggle="modal" data-target="#modal-admin-action-update-image" class="btn dropdown-item">
                                                <i class="fas fa-image"> View Image</i>
                                            </a>
                                        </div>

                                    </div>
                            </td>
                        </tr>';
        }
        return $result;
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
//        dd($id);
        $user_detail = User::find($id);
//        dd($user_detail);
        return view('user.user_update_detail')->with(['user_detail'=>$user_detail]);
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
            'txtName' => 'required|max:50',
//            'txtPassword' => 'required|min:7|max:100',
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
        $data_area_update =DB::table('users')->where('id','=',$request->user_id)
            ->update([
                'login'=>$request->txtName,
//                'password'=>$request->txtPassword,
                'first_name'=>$request->txtFName,
                'last_name'=>$request->txtLName,
                'email'=>$request->txtEmail,
                'phone'=>$request->txtPhone,
                'dob'=>$request->txtDob,
                'gender'=>$request->txtGender,
                'line'=>$request->txtLine,
                'store_id'=>$request->store,
                'department_id'=>$request->department,
                'service_id'=>$request->service,
                'position_id'=>$request->position,
                'contract_id'=>$request->contract,
                'contract_number'=>$request->txtNContract,
                'start_time'=>$request->txtStart,
                'end_time'=>$request->txtEnd,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
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

    public function update_detail(Request $request){
        $validator = \Validator::make($request->all(),[
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
        $noti= array(
            'message' => ' Cập nhật chi tiết lỗi! Hãy kiểm tra lại thông tin tài khoản và nhập lại !',
            'alert-type' => 'error'
        );
        if ($validator->fails()) {
            return Redirect::back()
                ->with($noti)
                ->withErrors($validator)
                ->withInput();
        }
        $data_area_update =DB::table('users')->where('id','=',$request->user_id)
            ->update([
                'identity_number'=>$request->txtIdentity,
                'tin'=>$request->txtTIN,
                'idn_date'=>$request->txtIdndate,
                'idn_address'=>$request->txtIdnAdd,
                'ssc_number'=>$request->txtNssc,
                'hospital'=>$request->txtHospital,
                'ban'=>$request->txtBan,
                'bank'=>$request->txtBank,
                'noi_address'=>$request->txtAdd_Noi,
                'address_now'=>$request->txtAddr_Now,
            ]);
        if($data_area_update = 1){
            $notification = array(
                'message' => 'Cập nhật chi tiết thông tin thành công!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Cập nhật chi tiết thông tin không thành công!',
                'alert-type' => 'error'
            );
        }
        return Redirect::back()->with($notification);
    }


    public function store_area(Request $request){
        $area_id = $request->area;
        $stores = Store::where('area_id',$area_id)
            ->get();

        return response()->json([
            'stores' => $stores
        ]);
    }

    public function viewImage($id){
        $user = User::find($id);
        return view('user.user_update_image')->with(['user'=>$user]);
    }
    public function updateImage(Request $request){
        $data_image_update =DB::table('users')->where('id','=',$request->user_id)
            ->update([
                'url_image'=>$request->url_image,
            ]);
        if($data_image_update = 1){
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

    public function convert_name($str){
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }

    public function createUserLogin($stringname){
        $arr = explode(" ",$stringname);
        $name = "";
        for($i = 0; $i < count($arr); $i++){
            if($i != count($arr)-1){
                $name = $name . substr($arr[$i],0,1);
            }else{
                $name = $arr[$i].$name;
            }
        }
        return $name;
    }


    public function import(Request $request){
        $path1 = $request->file('file')->store('temp');
        $path=storage_path('app').'/'.$path1;
        $data = \Excel::toArray(new UsersImport,$path);
        if(count($data[0]) > 0){
            foreach ($data as $key =>$value){
                foreach ($value as $key1 => $row) {
                    if($key1 > 0) {
                        if ($row[24] == null) {
                            $convert_name = $this->convert_name($row[4]);
                            $login = $this->createUserLogin($convert_name).substr($row[10],-1);
                        }elseif ($row[24] != null){
                            $login = $row[24];
                        }
                        if ($row[23] == null) {
                            $password = Hash::make('11111111');
                        }elseif ($row[23] != null){
                            $password = Hash::make($row[23]);
                        }
                        if(is_numeric($row[28]) == 1){
                            $ban = $row[28];
                        }elseif (is_numeric($row[28]) !=1){
                            $ban = null;
                        }
                        if($row[16] == '' || $row[16] == ' '){
                           $tin = 0;
                        }else{
                            $tin = $row[16];
                        }
                        if(is_numeric($row[13]) == 1){
                            $ssc_number = $row[13];
                        }else{
                            $ssc_number = 0;
                        }
                        $insert_data[] = array(
                            'login' => $login,
                            'password' => $password,
                            'first_name' => '',
                            'last_name' => $row[4],
                            'email' => $row[24],
                            'phone' => $row[23],
                            'dob' => date("Y-m-d", strtotime(str_replace("/", ".", $row[6]))),
                            'address' => '',
                            'gender' => $request->txtGender,
                            'url_image' => '',
                            'line' => $row[19],
                            'store_id' => $request->store_import,
                            'department_id' => $request->department_import,
                            'service_id' => $request->service_import,
                            'position_id' => $request->position_import,
                            'contract_id' => $request->contract_import,
                            'contract_number' => $row[37],
                            'start_time' => date("Y-m-d", strtotime(str_replace("/", ".", $row[39]))),
                            'end_time' => date("Y-m-d", strtotime(str_replace("/", ".", $row[40]))),
                            'identity_number' => $row[10],
                            'tin' => $tin,
                            'idn_date' => date("Y-m-d", strtotime(str_replace("/", ".", $row[11]))),
                            'idn_address' => $row[12],
                            'ssc_number' => $ssc_number,
                            'hospital' => $row[14],
                            'ban' => $ban,
                            'bank' => $row[29],
                            'noi_address' => $row[17],
                            'address_now' => $row[18],
                        );
                    }
                }
            }
//            dd($insert_data);
            if(!empty($insert_data))
            {
//                try {
                    DB::table('users')->insert($insert_data);
//                }catch ( \Illuminate\Database\QueryException $exception){
//                    $notification = array(
//                        'message' => 'Import not success!',
//                        'alert-type' => 'error'
//                    );
//                    return back()->with($notification);
//                }
                $notification = array(
                    'message' => 'Import not success!',
                    'alert-type' => 'success'
                );

            }
        }
        return back()->with($notification);
    }
}
