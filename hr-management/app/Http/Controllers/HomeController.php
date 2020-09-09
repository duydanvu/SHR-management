<?php

namespace App\Http\Controllers;

use App\Area;
use App\PoolAction;
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
            ->where('position_id','=',3)
            ->groupBy('company.id','company.name')
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
}
