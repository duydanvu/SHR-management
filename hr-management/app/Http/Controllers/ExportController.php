<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportController extends Controller implements FromCollection,WithHeadings
{
    private  $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    //
    public function collection()
    {
        $users = User::join('stores','users.store_id','=','stores.store_id')
            ->join('positions','users.position_id','=','positions.position_id')
            ->join('contracts','users.contract_id','=','contracts.contract_id')
            ->join('departments','users.department_id','=','departments.id')
            ->join('services','users.service_id','=','services.id')
            ->select('stores.store_address','positions.description as ps_description'
                ,'contracts.description as ct_description','departments.description as dp_description',
                'services.description as sv_description')
            ->where('users.store_id','=',$this->request->store_export)
            ->where('users.position_id','=',$this->request->position_export)
            ->where('users.contract_id','=',$this->request->contract_export)
            ->where('users.department_id','=',$this->request->department_export)
            ->where('users.service_id','=',$this->request->service_export)
            ;
        $arr = [];
        if ($this->request->name_ex != null){
            $users = $users->addSelect('users.first_name','users.last_name');
            array_push($arr,'first_name','last_name');
        }
        if($this->request->email_ex != null){
            $users = $users->addSelect('users.email');
            array_push($arr,'email');
        }
        if($this->request->phone_ex != null){
            $users = $users->addSelect('users.phone');
            array_push($arr,'phone');
        };
        if($this->request->dob_ex != null){
            $users = $users->addSelect('users.dob');
            array_push($arr,'dob');
        };
        if($this->request->gender_ex != null){
            $users = $users->addSelect('users.gender');
            array_push($arr,'gender');
        };
        if($this->request->line_ex != null){
            $users = $users->addSelect('users.line');
            array_push($arr,'line');
        };
        if($this->request->NContract_ex != null){
            $users = $users->addSelect('users.contract_number');
            array_push($arr,'contract_number');
        };
        if($this->request->start_time_ex != null){
            $users = $users->addSelect('users.start_time');
            array_push($arr,'start_time');
        };
        if($this->request->end_time_ex != null){
            $users = $users->addSelect('users.end_time');
            array_push($arr,'end_time');
        };
        if($this->request->idNumber_ex != null){
            $users = $users->addSelect('users.identity_number');
            array_push($arr,'identity_number');
        };
        if($this->request->tin_ex != null){
            $users = $users->addSelect('users.tin');
            array_push($arr,'tin');
        };
        if($this->request->idDate_ex != null){
            $users = $users->addSelect('users.idn_date');
            array_push($arr,'idn_date');
        };
        if($this->request->idAddress_ex != null){
            $users = $users->addSelect('users.idn_address');
            array_push($arr,'idn_address');
        };
        if($this->request->sscNumber_ex != null){
            $users = $users->addSelect('users.ssc_number');
            array_push($arr,'ssc_number');
        };
        if($this->request->hospital_ex != null){
            $users = $users->addSelect('users.hospital');
            array_push($arr,'hospital');
        };
        if($this->request->ban_ex != null){
            $users = $users->addSelect('users.ban');
            array_push($arr,'ban');
        };
        if($this->request->bank_ex != null){
            $users = $users->addSelect('users.bank');
            array_push($arr,'bank');
        };
        if($this->request->noi_add_ex != null){
            $users = $users->addSelect('users.noi_address');
            array_push($arr,'noi_address');
        };
        if($this->request->add_now_ex != null){
            $users = $users->addSelect('users.address_now');
            array_push($arr,'address_now');
        };
        $users_arr = [];
        $export =[];
        foreach ($users->get() as $item => $row) {
            foreach ($arr as $value) {
                array_push($users_arr,$row->$value);
            }
            $export[$item]=$users_arr;
            $users_arr=[];
        }
        return (collect($export));
    }

    public function headings(): array
    {
        $arr = [];
        if ($this->request->name_ex != null){
            array_push($arr,'Họ','Tên');
        }
        if($this->request->email_ex != null){
            array_push($arr,'Email');
        }
        if($this->request->phone_ex != null){
            array_push($arr,'Phone');
        };
        if($this->request->dob_ex != null){
            array_push($arr,'Ngày sinh');
        };
        if($this->request->gender_ex != null){
            array_push($arr,'Giới tính');
        };
        if($this->request->line_ex != null){
            array_push($arr,'Trình độ chuyên mon');
        };
        if($this->request->NContract_ex != null){
            array_push($arr,'Số Hợp Đồng');
        };
        if($this->request->start_time_ex != null){
            array_push($arr,'NGày bắt đầu');
        };
        if($this->request->end_time_ex != null){
            array_push($arr,'Ngày kết thúc');
        };
        if($this->request->idNumber_ex != null){
            array_push($arr,'Số CNT');
        };
        if($this->request->tin_ex != null){
            array_push($arr,'Mã Số thuế cá nhân');
        };
        if($this->request->idDate_ex != null){
            array_push($arr,'Ngày cấp CMT');
        };
        if($this->request->idAddress_ex != null){
            array_push($arr,'Nơi cấp CMT');
        };
        if($this->request->sscNumber_ex != null){
            array_push($arr,'Số bảo hiểm xã hội');
        };
        if($this->request->hospital_ex != null){
            array_push($arr,'Nơi đăng ký khám');
        };
        if($this->request->ban_ex != null){
            array_push($arr,'Số tài khoản ngân hàng');
        };
        if($this->request->bank_ex != null){
            array_push($arr,'Tên ngân hàng');
        };
        if($this->request->noi_add_ex != null){
            array_push($arr,'Địa chỉ thường trú');
        };
        if($this->request->add_now_ex != null){
            array_push($arr,'Nơi ở hiện tại');
        };
        return $arr;
    }
}
