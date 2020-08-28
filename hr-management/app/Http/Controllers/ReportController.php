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
            ->join('area','stores.area_id','=','area.id')
            ->select('users.*','stores.store_name','positions.position_name','contracts.name as ct_name',
                'departments.name as dp_name','services.name as sv_name','area.area_description')
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
        $user_detail = User::find($id);
//        dd($user_detail);
        return view('report.view_user_report_detail')->with(['user_detail'=>$user_detail]);
    }

    public function export_users(Request $request){
        return Excel::download(new ExportController($request),'user.xlsx');
    }

    public function showDetailTime(){
        return view('report.report_staff_detail');
    }

    public function searchReport(Request $request){
        $result = null;
        $user = User::join('stores','users.store_id','=','stores.store_id')
            ->join('positions','users.position_id','=','positions.position_id')
            ->join('contracts','users.contract_id','=','contracts.contract_id')
            ->join('departments','users.department_id','=','departments.id')
            ->join('services','users.service_id','=','services.id')
            ->join('area','stores.area_id','=','area.id')
            ->select('users.*','stores.store_name','positions.position_name',
                'contracts.name as ct_name','departments.name as dp_name','services.name as sv_name','area.area_description');
//            ->where('users.store_id','=',$request->store_search)
//            ->where('users.position_id','=',$request->position_search)
//            ->where('users.contract_id','=',$request->contract_search)
//            ->where('users.department_id','=',$request->department_search)
//            ->where('users.service_id','=',$request->service_search)
//            ->get();

        if($request->area_search === 'all'){
            $user_area = $user;
        }else{
            $user_area = $user->where('stores.area_id','=',$request->area_search);
        }

        if($request->store_search === 'all'){
            $user_store = $user_area;
        }else{
            $user_store = $user_area->where('users.store_id','=',$request->store_search);
        }

        if($request->position_search === 'all'){
            $user_position = $user_store;
        }else{
            $user_position = $user_store->where('users.position_id','=',$request->position_search);
        }

        if($request->contract_search === 'all'){
            $user_contract = $user_position;
        }else{
            $user_contract = $user_position->where('users.contract_id','=',$request->contract_search);
        }

        if($request->department_search === 'all'){
            $user_department = $user_contract;
        }else{
            $user_department = $user_contract->where('users.department_id','=',$request->department_search);
        }

        if($request->service_search === 'all'){
            $user_service = $user_department;
        }else{
            $user_service = $user_department->where('users.service_id','=',$request->service_search);
        }
        if($request->start_date == null && $request->end_date == null){
                $user_time = $user_service;
        }elseif ($request->start_date == null && $request->end_date != null){
                $user_time = $user_service->where('users.end_time','<=',$request->end_date);
        }elseif ($request->start_date != null && $request->end_date == null){
                $user_time = $user_service->where('users.start_time','>',$request->start_date);
        }else{
            if(strtotime($request->start_date) < strtotime($request->end_date)){
                $user_time = $user_service->whereBetween('users.end_time',[$request->start_date,$request->end_date]);
            } else if (strtotime($request->start_date) == strtotime($request->end_date)){
                $user_time = $user_service->whereBetween('users.end_time',[$request->start_date,$request->end_date]);
            }else{
                $user_time = $user_service;
            }
        }

        foreach ($user_time->get() as $key => $value){
            $result .= '<tr>';
            $result .= '<td>'.($key+1).'</td>';
            $result .= '<td>'.($value->store_name).'</td>';
            $result .= '<td>'.($value->first_name).' '.($value->last_name).'</td>';
            $result .= '<td style="width:10%">'.($value->email).'</td>';
            $result .= '<td>'.(str_replace("/","-",$value->phone)).'</td>';
            $result .= '<td>'.($value->dob).'</td>';
            $result .= '<td>'.($value->line).'</td>';
            $result .= '<td>'.($value->position_name).'</td>';
            $result .= '<td>'.($value->dp_name).'</td>';
            $result .= '<td>'.($value->sv_name).'</td>';
            $result .= '<td>'.($value->ct_name).'</td>';
            $result .= '<td>'.($value->contract_number).'</td>';
            $result .= '<td>'.($value->start_time).'</td>';
            $result .= '<td>'.($value->end_time).'</td>';
            $result .= '<td class="text-center">
                                <a href="'.route('view_user_detail_report',['id'=>$value->id]).'" data-remote="false"
                                   data-toggle="modal" data-target="#modal-admin-action-update-detail" class="btn dropdown-item">
                                    <i class="fas fa-info-circle">detail</i>
                                </a>
                            </td>
                        </tr>';
        }
        return $result;
    }
}
