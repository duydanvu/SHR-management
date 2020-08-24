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
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function showReportTime(){
        $store = Store::all();
        $position = Position::all();
        $contract = Contract::all();
        $department = Department::all();
        $service = Services::all();
        $area = Area::all();
        $store1 = Store::all();
        $position1 = Position::all();
        $contract1 = Contract::all();
        $department1 = Department::all();
        $service1 = Services::all();
        $area1 = Area::all();
        $user = User::join('stores','users.store_id','=','stores.store_id')
            ->join('positions','users.position_id','=','positions.position_id')
            ->join('contracts','users.contract_id','=','contracts.contract_id')
            ->join('departments','users.department_id','=','departments.id')
            ->join('services','users.service_id','=','services.id')
            ->select('users.*','stores.store_name','positions.position_name','contracts.name as ct_name','departments.name as dp_name','services.name as sv_name')
            ->get();
        return view('report.report_with_time')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'area' => $area,
            'store1'=>$store1,
            'position1'=>$position1,
            'contract1'=>$contract1,
            'department1'=>$department1,
            'service1' =>$service1,
            'area1' => $area1]);
    }

    public function view_detail($id){
        $user_detail = UserDetail::where('id_user','=',$id)->first();
//        dd($user_detail);
        return view('report.view_user_report_detail')->with(['user_detail'=>$user_detail]);
    }

    public function export_users(Request $request){
        return Excel::download(new ExportController($request),'user.xlsx');
    }

    public function showDetailTime(){
        return view('report.report_staff_detail');
    }


}
