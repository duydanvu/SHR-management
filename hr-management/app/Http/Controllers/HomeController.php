<?php

namespace App\Http\Controllers;

use App\Area;
use App\Contract;
use App\Department;
use App\PoolAction;
use App\Position;
use App\Services;
use App\Store;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $area = DB::table('company')
            ->leftJoin('area','area.company_id','=','company.id')
            ->select('company.id','company.name', DB::raw('COUNT(area.company_id) AS sum'))
            -> addSelect(DB::raw("'0' as GDV"))
            -> addSelect(DB::raw("'0' as NVBH"))
            -> addSelect(DB::raw("'0' as NVDT"))
            -> addSelect(DB::raw("'0' as AM"))
            -> addSelect(DB::raw("'0' as KAM"))
            -> addSelect(DB::raw("'0' as CT"))
            -> addSelect(DB::raw("'0' as TV"))
            ->groupBy('company.name')
            ->groupBy('company.id')
            ->orderBy('company.name')
            ->get();
        $user_gdv = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->join('company','area.company_id','=','company.id')
            ->select('company.id','company.name',DB::raw('COUNT(users.position_id) AS sum_gdv'))
            ->where('position_id','=',4)
            ->groupBy('company.id','company.name')
            ->get();

        foreach ($area as $value){
            foreach ($user_gdv as $value1){
                if($value->id === $value1->id){
                    $value->GDV = $value1->sum_gdv;
                }
            }
        }

        $user_nvbh = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->join('company','area.company_id','=','company.id')
            ->select('company.id','company.name',DB::raw('COUNT(users.position_id) AS sum_nvbh'))
            ->where('position_id','=',8)
            ->groupBy('company.id','company.name')
            ->get();

        foreach ($area as $value){
            foreach ($user_nvbh as $value1){
                if($value->id === $value1->id){
                    $value->NVBH = $value1->sum_nvbh;
                }
            }
        }

        $user_nvdt = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->join('company','area.company_id','=','company.id')
            ->select('company.id','company.name',DB::raw('COUNT(users.position_id) AS sum_nvdt'))
            ->where('position_id','=',9)
            ->groupBy('company.id','company.name')
            ->get();

        foreach ($area as $value){
            foreach ($user_nvbh as $value1){
                if($value->id === $value1->id){
                    $value->NVDT = $value1->sum_nvdt;
                }
            }
        }

        $user_am = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->join('company','area.company_id','=','company.id')
            ->select('company.id','company.name',DB::raw('COUNT(users.position_id) AS sum_am'))
            ->where('position_id','=',5)
            ->groupBy('company.id','company.name')
            ->get();
        foreach ($area as $value){
            foreach ($user_am as $value1){
                if($value->id === $value1->id){
                    $value->AM = $value1->sum_am;
                }
            }
        }
        $user_kam = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->join('company','area.company_id','=','company.id')
            ->select('company.id','company.name',DB::raw('COUNT(users.position_id) AS sum_kam'))
            ->where('position_id','=',6)
            ->groupBy('company.id','company.name')
            ->get();
        foreach ($area as $value){
            foreach ($user_kam as $value1){
                if($value->id === $value1->id){
                    $value->KAM = $value1->sum_kam;
                }
            }
        }
        $user_ct = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->join('company','area.company_id','=','company.id')
            ->select('company.id','company.name',DB::raw('COUNT(users.contract_id) AS sum_ct'))
            ->where('contract_id','=',1)
            ->groupBy('company.id','company.name')
            ->get();
        foreach ($area as $value){
            foreach ($user_ct as $value1){
                if($value->id === $value1->id){
                    $value->CT = $value1->sum_ct;
                }
            }
        }
        $user_tv = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->join('company','area.company_id','=','company.id')
            ->select('company.id','company.name',DB::raw('COUNT(users.contract_id) AS sum_tv'))
            ->where('contract_id','=',2)
            ->groupBy('company.id','company.name')
            ->get();
        foreach ($area as $value){
            foreach ($user_tv as $value1){
                if($value->id === $value1->id){
                    $value->TV = $value1->sum_tv;
                }
            }
        }
        return view('welcome',compact('area'));
    }

    public function detail_nv_of_company($id){
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
            ->join('area','area.id','=','stores.area_id')
            ->join('company','company.id','=','area.company_id')
            ->select('users.*','stores.store_name')
            ->where('company.id','=',$id)
            ->get();
        $company_name = DB::table('company')->find($id)->name;
        return view('home_detail.detail_company')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'store_name'=>'Company - '.$company_name,
            'store1'=>$store1,
            'position1'=>$position1,
            'contract1'=>$contract1,
            'department1'=>$department1,
            'service1' =>$service1,
            'area' => $area]);
    }

    public function detail_KAM_of_company($id){
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
            ->join('area','area.id','=','stores.area_id')
            ->join('company','company.id','=','area.company_id')
            ->select('users.*','stores.store_name')
            ->where('company.id','=',$id)
            ->where('positions.position_name','=','KAM')
            ->get();
        $company_name = DB::table('company')->find($id)->name;
        return view('home_detail.detail_company')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'store_name'=>'Company - '.$company_name,
            'store1'=>$store1,
            'position1'=>$position1,
            'contract1'=>$contract1,
            'department1'=>$department1,
            'service1' =>$service1,
            'area' => $area]);
    }

    public function detail_AM_of_company($id){
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
            ->join('area','area.id','=','stores.area_id')
            ->join('company','company.id','=','area.company_id')
            ->select('users.*','stores.store_name')
            ->where('company.id','=',$id)
            ->where('positions.position_name','=','AM')
            ->get();
        $company_name = DB::table('company')->find($id)->name;
        return view('home_detail.detail_company')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'store_name'=>'Company - '.$company_name,
            'store1'=>$store1,
            'position1'=>$position1,
            'contract1'=>$contract1,
            'department1'=>$department1,
            'service1' =>$service1,
            'area' => $area]);
    }

    public function detail_GDV_of_company($id){
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
            ->join('area','area.id','=','stores.area_id')
            ->join('company','company.id','=','area.company_id')
            ->select('users.*','stores.store_name')
            ->where('company.id','=',$id)
            ->where('positions.position_name','=','GDV')
            ->get();
        $company_name = DB::table('company')->find($id)->name;
        return view('home_detail.detail_company')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'store_name'=>'Company - '.$company_name,
            'store1'=>$store1,
            'position1'=>$position1,
            'contract1'=>$contract1,
            'department1'=>$department1,
            'service1' =>$service1,
            'area' => $area]);
    }

    public function detail_NVBH_of_company($id){
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
            ->join('area','area.id','=','stores.area_id')
            ->join('company','company.id','=','area.company_id')
            ->select('users.*','stores.store_name')
            ->where('company.id','=',$id)
            ->where('positions.position_name','=','NVBH')
            ->get();
        $company_name = DB::table('company')->find($id)->name;
        return view('home_detail.detail_company')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'store_name'=>'Company - '.$company_name,
            'store1'=>$store1,
            'position1'=>$position1,
            'contract1'=>$contract1,
            'department1'=>$department1,
            'service1' =>$service1,
            'area' => $area]);
    }

    public function detail_NVDT_of_company($id){
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
            ->join('area','area.id','=','stores.area_id')
            ->join('company','company.id','=','area.company_id')
            ->select('users.*','stores.store_name')
            ->where('company.id','=',$id)
            ->where('positions.position_name','=','NVDT')
            ->get();
        $company_name = DB::table('company')->find($id)->name;
        return view('home_detail.detail_company')->with([
            'user'=>$user,
            'store'=>$store,
            'position'=>$position,
            'contract'=>$contract,
            'department'=>$department,
            'service' =>$service,
            'store_name'=>'Company - '.$company_name,
            'store1'=>$store1,
            'position1'=>$position1,
            'contract1'=>$contract1,
            'department1'=>$department1,
            'service1' =>$service1,
            'area' => $area]);
    }

    public function detail_area_of_company($id){
        $area = Area::leftJoin('stores','area.id','=','stores.area_id')
            ->join('company','company.id','=','area.company_id')
            ->select('area.id','area.area_name','area.area_description', DB::raw('COUNT(stores.area_id) AS sum'))
            -> addSelect(DB::raw("'0' as GDV"))
            -> addSelect(DB::raw("'0' as AM"))
            -> addSelect(DB::raw("'0' as KAM"))
            -> addSelect(DB::raw("'0' as CT"))
            -> addSelect(DB::raw("'0' as TV"))
            ->where('company.id','=',$id)
            ->groupBy('stores.area_id')
            ->groupBy('area.id')
            ->groupBy('area.area_name')
            ->groupBy('area.area_description')
            ->orderBy('area.area_name')
            ->get();
        $user_gdv = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->select('area.id','area.area_name',DB::raw('COUNT(users.position_id) AS sum_gdv'))
            ->where('position_id','=',3)
            ->groupBy('area.area_name','area.id')
            ->get();
        foreach ($area as $value){
            foreach ($user_gdv as $value1){
                if($value->id === $value1->id){
                    $value->GDV = $value1->sum_gdv;
                }
            }
        }
        $user_am = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->select('area.id','area.area_name',DB::raw('COUNT(users.position_id) AS sum_am'))
            ->where('position_id','=',5)
            ->groupBy('area.id','area.area_name')
            ->get();
        foreach ($area as $value){
            foreach ($user_am as $value1){
                if($value->id === $value1->id){
                    $value->AM = $value1->sum_am;
                }
            }
        }
        $user_kam = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->select('area.id','area.area_name',DB::raw('COUNT(users.position_id) AS sum_kam'))
            ->where('position_id','=',6)
            ->groupBy('area.id','area.area_name')
            ->get();
        foreach ($area as $value){
            foreach ($user_kam as $value1){
                if($value->id === $value1->id){
                    $value->KAM = $value1->sum_kam;
                }
            }
        }
        $user_ct = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->select('area.id','area.area_name',DB::raw('COUNT(users.contract_id) AS sum_nvbh'))
            ->where('position_id','=',8)
            ->groupBy('area.id','area.area_name')
            ->get();
        foreach ($area as $value){
            foreach ($user_ct as $value1){
                if($value->id === $value1->id){
                    $value->CT = $value1->sum_ct;
                }
            }
        }
        $user_tv = User::join('stores','users.store_id','=','stores.store_id')
            ->join('area','stores.area_id','=','area.id')
            ->select('area.id','area.area_name',DB::raw('COUNT(users.contract_id) AS sum_nvdt'))
            ->where('position_id','=',9)
            ->groupBy('area.id','area.area_name')
            ->get();
        foreach ($area as $value){
            foreach ($user_tv as $value1){
                if($value->id === $value1->id){
                    $value->TV = $value1->sum_tv;
                }
            }
        }
        return view('home_detail.detail_company_area',compact('area'));
    }

    public function index_system(){
        return view('welcome2');
    }
}
