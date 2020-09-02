<?php


namespace App\Http\Controllers;


use App\Timesheet;
use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportTimesheetController extends Controller implements FromCollection,WithHeadings
{


    private  $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    //
    public function collection()
    {
        $user = User::join('stores','users.store_id','=','stores.store_id')
            ->join('positions','users.position_id','=','positions.position_id')
            ->join('contracts','users.contract_id','=','contracts.contract_id')
            ->join('departments','users.department_id','=','departments.id')
            ->join('services','users.service_id','=','services.id')
            ->join('timesheets','users.id','=','timesheets.user_id')
            ->select(DB::raw('DISTINCT users.id as id'),'users.last_name'
                ,'users.email','stores.store_name',
                'positions.position_name','contracts.name as ct_name'
                ,'departments.name as dp_name','services.name as sv_name')
            -> addSelect(DB::raw("'0' as present"))
            -> addSelect(DB::raw("'0' as absent_yes"))
            -> addSelect(DB::raw("'0' as absent_no"));
        ;

        if($this->request->area_search === 'all'){
            $user_area = $user;
        }else{
            $user_area = $user->where('stores.area_id','=',$this->request->area_search);
        }
        if($this->request->store_search === 'all'){
            $user_store = $user_area;
        }else{
            $user_store = $user_area->where('users.store_id','=',$this->request->store_search);
        }

        if($this->request->position_search === 'all'){
            $user_position = $user_store;
        }else{
            $user_position = $user_store->where('users.position_id','=',$this->request->position_search);
        }

        if($this->request->contract_search === 'all'){
            $user_contract = $user_position;
        }else{
            $user_contract = $user_position->where('users.contract_id','=',$this->request->contract_search);
        }

        if($this->request->department_search === 'all'){
            $user_department = $user_contract;
        }else{
            $user_department = $user_contract->where('users.department_id','=',$this->request->department_search);
        }
        if($this->request->service_search === 'all'){
            $user_service = $user_department;
        }else{
            $user_service = $user_department->where('users.service_id','=',$this->request->service_search);
        }
        if($this->request->txtStartDate !== null && $this->request->txtEndDate !== null){
            if(strtotime($this->request->txtStartDate) > strtotime($this->request->txtEndDate)){
                $user_time = $user_service;
                $user_present = Timesheet::where('logtime','=','present')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as present'))
                    ->groupBy('logtime','user_id')
                    ->get();
                $user_absent_yes = Timesheet::where('logtime','=','absent')
                    ->where('comment','<>',null)
                    ->where('status','=','done')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_yes'))
                    ->groupBy('logtime','user_id')
                    ->get();
                $user_absent_no = Timesheet::where('logtime','=','absent')
                    ->where('comment','=',null)
                    ->where('status','=','done')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_no'))
                    ->groupBy('logtime','user_id')
                    ->get();
            } else if (strtotime($this->request->txtStartDate) == strtotime($this->request->txtEndDate)){
                $user_time = $user_service->where('timesheets.date','=',$this->request->txtEndDate);
                $user_present = Timesheet::where('logtime','=','present')
                    ->whereBetween('date','=',$this->request->end_date)
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as present'))
                    ->groupBy('logtime','user_id')
                    ->get();
                $user_absent_yes = Timesheet::where('logtime','=','absent')
                    ->whereBetween('date','=',$this->request->txtEndDate)
                    ->where('comment','<>',null)
                    ->where('status','=','done')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_yes'))
                    ->groupBy('logtime','user_id')
                    ->get();
                $user_absent_no = Timesheet::where('logtime','=','absent')
                    ->whereBetween('date','=',$this->request->txtEndDate)
                    ->where('comment','=',null)
                    ->where('status','=','done')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_no'))
                    ->groupBy('logtime','user_id')
                    ->get();
            }else{
                $user_time = $user_service->whereBetween('timesheets.date',[$this->request->txtStartDate,$this->request->txtEndDate]);
                $user_present = Timesheet::where('logtime','=','present')
                    ->whereBetween('date',[$this->request->txtStartDate,$this->request->txtEndDate])
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as present'))
                    ->groupBy('logtime','user_id')
                    ->get();
                $user_absent_yes = Timesheet::where('logtime','=','absent')
                    ->whereBetween('date',[$this->request->txtStartDate,$this->request->txtEndDate])
                    ->where('comment','<>',null)
                    ->where('status','=','done')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_yes'))
                    ->groupBy('logtime','user_id')
                    ->get();
                $user_absent_no = Timesheet::where('logtime','=','absent')
                    ->whereBetween('date',[$this->request->txtStartDate,$this->request->txtEndDate])
                    ->where('comment','=',null)
                    ->where('status','=','done')
                    ->select(DB::raw('DISTINCT user_id'),DB::raw('COUNT(logtime) as absent_no'))
                    ->groupBy('logtime','user_id')
                    ->get();
            }
        }else{
            $user_time = $user_service;
        }
        $user_rs = $user_time->get();
        foreach ($user_rs as $value_user){
            foreach ($user_present as $value_present){
                if($value_present->user_id === $value_user->id){
                    $value_user->present = $value_present->present;
                }
            }
        }
        foreach ($user_rs as $value_user){
            foreach ($user_absent_yes as $value_ab_yes){
                if($value_ab_yes->user_id === $value_user->id){
                    $value_user->absent_yes = $value_ab_yes->absent_yes;
                }
            }
        }
        foreach ($user_rs as $value_user){
            foreach ($user_absent_no as $value_ab_no){
                if($value_ab_no->user_id === $value_user->id){
                    $value_user->absent_no = $value_ab_no->absent_no;
                }
            }
        }
        return $user_rs;
    }

    public function headings(): array
    {

        return [
            'STT',
            'Tên',
            'Email',
            'Cửa Hàng',
            'Chức Vụ',
            'Hợp Đồng',
            'Bộ Phận',
            'Dịch Vụ',
            'Số Ngày Làm',
            'Số Ngày Nghỉ Có Phép',
            'Số Ngày Nghỉ Không Phép'
        ];
    }
}
