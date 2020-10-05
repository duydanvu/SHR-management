<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KtktController extends Controller
{
    public function listHoanUng(){
        $curDate = date("Y-m-d");
        $table = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        $list_hoan_ung = DB::table($table)
            ->join('products','id_product','=','products.id')
            ->join('users','id_user','=','users.id')
            ->where('status_transport','=','done')
            ->where('status_payment','=','done')
//            ->where('status_kt','=','wait')
//            ->where('status_admin2','=','wait')
            ->select(''.$table.'.*','products.*')
            ->addSelect(''.$table.'.id as id_order')
            ->addSelect('users.last_name')
            ->addSelect('users.email')
            ->get();
        $product = Products::all();
        return view('ktkt.list_hoan_ung',compact('list_hoan_ung','product'));
    }

    public function view_detail_hoan_ung($id){
        $curDate = date("Y-m-d");
        $table = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        $order_hoan_ung = DB::table($table)->find($id);
        $product = Products::find($order_hoan_ung->id_product);
        return view('user2.detail_order_hoan_ung',compact('order_hoan_ung','product'));
    }

    public function action_update_hoan_ung_ktkt(Request $request){
        $id_order = $request->id_hoan_ung;
        $curDate = date("Y-m-d");
        $table1 = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        try {
            $update_hoan_ung = DB::table($table1)->where('id','=',$id_order)
                ->update([
                    'status_kt'=>'done',
                    'status_admin2'=>'done',
                ]);
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Kiểm tra lại thông tin hoàn ứng!',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        $notification = array(
            'message' => 'Hoàn ứng thành công !',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }
}
