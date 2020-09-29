<?php

namespace App\Http\Controllers;

use App\Products;
use App\Supplier;
use App\User;
use App\UserProduct;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class User2Controller extends Controller
{
    public function list_product(){
        $id_product = UserProduct::where('id_user','=',Auth::id())->get();
        $arr = [];
        foreach ($id_product as $value){
            array_push($arr,$value->id_product);
        }
        $product = Products::whereIn('id',$arr)->get();
        $supplier = Supplier::all();
        return view('user2.list_products',compact('product','supplier'));
    }
    public function list_view_product(){
        $id_product = UserProduct::where('id_user','=',Auth::id())->get();
        $arr = [];
        foreach ($id_product as $value){
            array_push($arr,$value->id_product);
        }
        $product = Products::whereIn('id',$arr)->get();
        $supplier = Supplier::all();
        return view('user2.view_list_product',compact('product','supplier'));
    }

    public function view_detail_product_user2($id){
        $product = Products::find($id);
        return view('user2.view_detail_product',compact('product'));
    }

    public function view_list_product_user2(){
        $id_product = UserProduct::where('id_user','=',Auth::id())->get();
        $arr = [];
        foreach ($id_product as $value){
            array_push($arr,$value->id_product);
        }
        $product = Products::whereIn('id',$arr)->get();
        $supplier = Supplier::all();
        return view('user2.view_list_detail_product',compact('product','supplier'));
    }

    public function add_new_sell_product(Request $request){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $curDate = date("Y-m-d");
        $curDateTime = date("Y-m-d H:i:s");
        $table = 'spd_log_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        $id_Auth = Auth::id();
        $validator = \Validator::make($request->all(),[
            'txtProductID' => 'required',
            'totalProduct' => 'required',
        ]);
        $notification= array(
            'message' => ' Kiểm tra nhập số lượng sản phẩm!',
            'alert-type' => 'error'
        );
        if ($validator ->fails()) {
            return Redirect::back()
                ->with($notification)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $han_muc_now = User::find(Auth::id())->han_muc;
            $product = Products::find($request['txtProductID']);
            if(($product->price_sale * $request['totalProduct']) > $han_muc_now){
                $notification = array(
                    'message' => 'hạn mức của bạn không đủ để thanh toán!',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }else {
                if ($product->hh_default != null) {
                    $create_sell_product = DB::table($table)->insertGetId([
                        'id_product' => $request['txtProductID'],
                        'id_user' => $id_Auth,
                        'total_product' => $request['totalProduct'],
                        'bonus_pr' => $product->hh_default,
                        'total_price' => $product->price_sale * $request['totalProduct'],
                        'total_bonus' => $product->hh_default * $request['totalProduct'],
                        'time' => $curDateTime,
                        'status_transport' => 'wait',
                        'status_payment' => 'wait',
                        'status_kt' => 'wait',
                        'status_admin2' => 'wait',
                    ]);
                } elseif ($product->hh_percent != null) {
                    $create_sell_product = DB::table($table)->insertGetId([
                        'id_product' => $request['txtProductID'],
                        'id_user' => $id_Auth,
                        'total_product' => $request['totalProduct'],
                        'bonus_pr' => $product->hh_percent,
                        'total_price' => $product->price_sale * $request['totalProduct'],
                        'total_bonus' => $product->price_sale * $request['totalProduct'] * $product->hh_percent / 100,
                        'time' => $curDateTime,
                        'status_transport' => 'wait',
                        'status_payment' => 'wait',
                        'status_kt' => 'wait',
                        'status_admin2' => 'wait',
                    ]);
                } else {
                    $notification = array(
                        'message' => 'Sản phẩm không phù hợp hoặc đã hết!',
                        'alert-type' => 'error'
                    );
                    return Redirect::back()->with($notification);
                }
            }

            if(!is_numeric($create_sell_product)){
                $notification = array(
                    'message' => 'Kiểm tra lại thông tin ',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }else{
                $select_warehouse = DB::table('warehouse_products')->orderBy('id','DESC')->first();
                $update_warehouse = DB::table('warehouse_products')->insert([
                    'id_product'=>$select_warehouse->id_product,
                    'id_warehouse'=>$select_warehouse->id_warehouse,
                    'contract_tc'=>1111,
                    'time'=>$curDateTime,
                    'total'=>$select_warehouse->total-$request['totalProduct'],
                    'type'=>'selling'
                ]);
                $sub_han_muc = DB::table('users')->where('id','=',Auth::id())
                    ->update([
                       'han_muc'=>$han_muc_now-($product->price_sale * $request['totalProduct']),
                    ]);
            }
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng kiểm tra lại ',
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

    public function shippingProduct(){
        $curDate = date("Y-m-d");
        $table = 'spd_log_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        $list_hoan_ung = DB::table($table)
            ->join('products','id_product','=','products.id')
            ->where('status_transport','=','wait')
            ->where('status_payment','=','wait')
            ->where('status_kt','=','wait')
            ->where('status_admin2','=','wait')
            ->select(''.$table.'.*','products.*')
            ->addSelect(''.$table.'.id as id_order')
            ->get();
        $product = Products::all();
        return view('user2.list_shipping_product',compact('list_hoan_ung','product'));
    }
    public function hoan_ung(){
        $curDate = date("Y-m-d");
        $table = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        $list_hoan_ung = DB::table($table)
            ->join('products','id_product','=','products.id')
            ->where('status_transport','=','done')
            ->where('status_payment','=','wait')
            ->where('status_kt','=','wait')
            ->where('status_admin2','=','wait')
            ->select(''.$table.'.*','products.*')
            ->addSelect(''.$table.'.id as id_order')
            ->get();
        $product = Products::all();
        return view('user2.list_hoan_ung',compact('list_hoan_ung','product'));
    }

    public function view_detail_hoan_ung($id){
        $curDate = date("Y-m-d");
        $table = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        $order_hoan_ung = DB::table($table)->find($id);
        $product = Products::find($order_hoan_ung->id_product);
        return view('user2.detail_order_hoan_ung',compact('order_hoan_ung','product'));
    }
    public function view_detail_shipping($id){
        $curDate = date("Y-m-d");
        $table = 'spd_log_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        $table1 = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        try {
            $order = DB::table($table)->find($id);
            $id_insert =DB::table($table1)->insertGetId([
                'id_product'=>$order->id_product,
                'total_product'=>$order->total_product,
                'id_user'=>$order->id_user,
                'email_guest'=>$order->email_guest,
                'phone_guest'=>$order->phone_guest,
                'bonus_pr'=>$order->bonus_pr,
                'total_price'=>$order->total_price,
                'total_bonus'=>$order->total_bonus,
                'time'=>$order->time,
                'status_transport'=>'done',
                'status_payment'=>'wait',
                'status_kt'=>'wait',
                'status_admin2'=>'wait',
            ]);
            if(!is_numeric($id_insert)){
                $notification = array(
                    'message' => 'Kiểm tra lại thông tin!',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }else{
                $delete_order = DB::table($table)->delete($id);
            }
        }catch (QueryException $ex){
            $notification = array(
                'message' => 'Kiểm tra lại thông tin hóa đơn!',
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


    public function action_update_hoan_ung_user2(Request $request){
        $id_order = $request->id_hoan_ung;
        $curDate = date("Y-m-d");
        $table1 = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        try {
            $update_hoan_ung = DB::table($table1)->where('id','=',$id_order)
                ->update([
                   'status_payment'=>'done',
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
