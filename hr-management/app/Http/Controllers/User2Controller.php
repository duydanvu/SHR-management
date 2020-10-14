<?php

namespace App\Http\Controllers;

use App\Code;
use App\Emulation;
use App\EmulationProducts;
use App\GoalProduct;
use App\GoalSales;
use App\LinkImage;
use App\Notification;
use App\Products;
use App\Supplier;
use App\TotalProductEmulation;
use App\User;
use App\UserProduct;
use App\Warehouse;
use App\WarehouseProduct;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

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
        $product = Products::whereIn('id',$arr)->orderBy('id','DESC')->limit(8)->get();
        $product_new = Products::whereIn('id',$arr)->orderBy('id','DESC')->limit(16)->get();
        $product_nb = Products::whereIn('id',$arr)->orderBy('id','DESC')
            ->where('price_sale','<>',null)
            ->limit(16)->get();
        $supplier = Supplier::all();
        return view('user2.view_list_product',compact('product','supplier','product_new','product_nb'));
    }

    public function view_detail_product_user2($id){
        $product = Products::find($id);
        $link_image = LinkImage::all();
        return view('user2.view_detail_product',compact('product','link_image'));
    }

    public function view_list_product_user2(){
        $id_product = UserProduct::where('id_user','=',Auth::id())->get();
        $arr = [];
        foreach ($id_product as $value){
            array_push($arr,$value->id_product);
        }
        $product = Products::whereIn('id',$arr) ->get();
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
            'txtEmailGuest' => 'required',
            'txtPhoneGuest' => 'required',
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
            $ware_house = WarehouseProduct::find($request['txtProductID'])->orderBy('id')->first()->total;
            if(($product->price_sale * $request['totalProduct']) > $han_muc_now || $ware_house <= 0){
                $notification = array(
                    'message' => 'hạn mức của bạn không đủ để thanh toán hoặc đã hết sản phẩm!',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }else {
                if ($product->hh_default != null) {
                    $check = Schema::hasTable($table);
                    if($check != true){
                        $create_table = Schema::create($table, function (Blueprint $tables) {
                            $tables->increments('id');
                            $tables->integer('id_product');
                            $tables->integer('total_product');
                            $tables->integer('id_user');
                            $tables->string('email_guest')->nullable();
                            $tables->string('phone_guest')->nullable();
                            $tables->integer('bonus_pr');
                            $tables->integer('total_price');
                            $tables->integer('total_bonus');
                            $tables->dateTime('time');
                            $tables->string('status_transport');
                            $tables->string('status_payment');
                            $tables->string('status_kt');
                            $tables->string('status_admin2');
                            $tables->timestamps();
                        });
                    }

                    $create_sell_product = DB::table($table)->insertGetId([
                        'id_product' => $request['txtProductID'],
                        'id_user' => $id_Auth,
                        'total_product' => $request['totalProduct'],
                        'email_guest' => $request['txtEmailGuest'],
                        'phone_guest' => $request['txtPhoneGuest'],
                        'bonus_pr' => $product->hh_default,
                        'total_price' => $product->price_sale * $request['totalProduct'],
                        'total_bonus' => $product->hh_default * $request['totalProduct'],
                        'time' => $curDateTime,
                        'status_transport' => 'done',
                        'status_payment' => 'wait',
                        'status_kt' => 'wait',
                        'status_admin2' => 'wait',
                    ]);
                } elseif ($product->hh_percent != null) {
                    $check = Schema::hasTable($table);
                    if($check != true){
                        $create_table = Schema::create($table, function (Blueprint $tables) {
                            $tables->increments('id');
                            $tables->integer('id_product');
                            $tables->integer('total_product');
                            $tables->integer('id_user');
                            $tables->string('email_guest')->nullable();
                            $tables->string('phone_guest')->nullable();
                            $tables->integer('bonus_pr');
                            $tables->integer('total_price');
                            $tables->integer('total_bonus');
                            $tables->dateTime('time');
                            $tables->string('status_transport');
                            $tables->string('status_payment');
                            $tables->string('status_kt');
                            $tables->string('status_admin2');
                            $tables->timestamps();
                        });
                    }

                    $create_sell_product = DB::table($table)->insertGetId([
                        'id_product' => $request['txtProductID'],
                        'id_user' => $id_Auth,
                        'total_product' => $request['totalProduct'],
                        'email_guest' => $request['txtEmailGuest'],
                        'phone_guest' => $request['txtPhoneGuest'],
                        'bonus_pr' => $product->hh_percent,
                        'total_price' => $product->price_sale * $request['totalProduct'],
                        'total_bonus' => $product->price_sale * $request['totalProduct'] * $product->hh_percent / 100,
                        'time' => $curDateTime,
                        'status_transport' => 'done',
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
                $select_warehouse = DB::table('warehouse_products')
                    ->where('id_product','=',$request['txtProductID'])
                    ->orderBy('id','DESC')->first();
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
                $table1 = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
                $order = DB::table($table)->find($create_sell_product);
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
                $name_product = Products::find($request['txtProductID'])->name;
                $insert_notification = DB::table('notifications')->insert([
                    'name'=>  'Bán sản phẩm '.$name_product,
                    'user_accept'=> 'admin2',
                    'content' => 'Bán sản phẩm '.$name_product,
                    'status' => 'wait',
                    'time'   => Carbon::now('Asia/Ho_Chi_Minh'),
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
        $type_sales_product = Products::find($order->id_product)->type_sale;

        $notification = array(
            'message' => 'Thêm thông tin thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }
    public function add_new_sell_product_code(Request $request){
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

            $ware_house = WarehouseProduct::where('id_product','=',$request['txtProductID'])->orderBy('id')->first()->total;
            if(($product->price_sale * $request['totalProduct']) > $han_muc_now || $ware_house < 0){
                $notification = array(
                    'message' => 'hạn mức của bạn không đủ để thanh toán hoặc đã hết sản phẩm!',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }else {
                $type_sales_product = Products::find($request['txtProductID'])->type_sale_code;
                $list_code = Code::where('type_code','=',$type_sales_product)->limit($request['totalProduct'])->select('code')->get();
                $str_code = '';
                foreach ($list_code as $value_list){
                    $str_code = $str_code.','.$value_list->code;
                }
                $str_code_rs = substr($str_code,1,strlen($str_code)-1);
                if ($product->hh_default != null) {
                    $check = Schema::hasTable($table);
                    if($check != true){
                        $create_table = Schema::create($table, function (Blueprint $tables) {
                            $tables->increments('id');
                            $tables->integer('id_product');
                            $tables->integer('total_product');
                            $tables->integer('id_user');
                            $tables->string('email_guest')->nullable();
                            $tables->string('phone_guest')->nullable();
                            $tables->string('list_code')->nullable();
                            $tables->integer('bonus_pr');
                            $tables->integer('total_price');
                            $tables->integer('total_bonus');
                            $tables->dateTime('time');
                            $tables->string('status_transport');
                            $tables->string('status_payment');
                            $tables->string('status_kt');
                            $tables->string('status_admin2');
                            $tables->timestamps();
                        });
                    }

                    $create_sell_product = DB::table($table)->insertGetId([
                        'id_product' => $request['txtProductID'],
                        'id_user' => $id_Auth,
                        'total_product' => $request['totalProduct'],
                        'email_guest' => $request['txtEmailGuest'],
                        'phone_guest' => $request['txtPhoneGuest'],
                        'list_code'=>$str_code_rs,
                        'bonus_pr' => $product->hh_default,
                        'total_price' => $product->price_sale * $request['totalProduct'],
                        'total_bonus' => $product->hh_default * $request['totalProduct'],
                        'time' => $curDateTime,
                        'status_transport' => 'done',
                        'status_payment' => 'wait',
                        'status_kt' => 'wait',
                        'status_admin2' => 'wait',
                    ]);
                } elseif ($product->hh_percent != null) {
                    $check = Schema::hasTable($table);
                    if($check != true){
                        $create_table = Schema::create($table, function (Blueprint $tables) {
                            $tables->increments('id');
                            $tables->integer('id_product');
                            $tables->integer('total_product');
                            $tables->integer('id_user');
                            $tables->string('email_guest')->nullable();
                            $tables->string('phone_guest')->nullable();
                            $tables->string('list_code')->nullable();
                            $tables->integer('bonus_pr');
                            $tables->integer('total_price');
                            $tables->integer('total_bonus');
                            $tables->dateTime('time');
                            $tables->string('status_transport');
                            $tables->string('status_payment');
                            $tables->string('status_kt');
                            $tables->string('status_admin2');
                            $tables->timestamps();
                        });
                    }

                    $create_sell_product = DB::table($table)->insertGetId([
                        'id_product' => $request['txtProductID'],
                        'id_user' => $id_Auth,
                        'total_product' => $request['totalProduct'],
                        'email_guest' => $request['txtEmailGuest'],
                        'phone_guest' => $request['txtPhoneGuest'],
                        'list_code'=>$str_code_rs,
                        'bonus_pr' => $product->hh_percent,
                        'total_price' => $product->price_sale * $request['totalProduct'],
                        'total_bonus' => $product->price_sale * $request['totalProduct'] * $product->hh_percent / 100,
                        'time' => $curDateTime,
                        'status_transport' => 'done',
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
                $select_warehouse = DB::table('warehouse_products')
                    ->where('id_product','=',$request['txtProductID'])
                    ->orderBy('id','DESC')->first();
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
                $table1 = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
                $order = DB::table($table)->find($create_sell_product);
                $id_insert =DB::table($table1)->insertGetId([
                    'id_product'=>$order->id_product,
                    'total_product'=>$order->total_product,
                    'id_user'=>$order->id_user,
                    'list_code'=>$order->list_code,
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
            }
        }
        catch (QueryException $ex){
            $notification = array(
                'message' => 'Thông tin không chính xác! Vui lòng kiểm tra lại ',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }
        try {
            $type_sales_product = Products::find($request['txtProductID'])->type_sale_code;

            $list_code = Code::where('type_code','=',$type_sales_product)->limit($request['totalProduct'])->select('code')->get();
            foreach ($list_code as $value_code_delete){
                $delete_code = Code::where('code','=',$value_code_delete->code)->delete();
            }
        }catch(QueryException $ex) {
            $notification = array(
                'message' => 'Không còn sản phẩm',
                'alert-type' => 'error'
            );
            return Redirect::back()->with($notification);
        }

        $notification = array(
                'message_listcode' => $list_code,
            );
        return Redirect::back()->with($notification);
    }

    public function shippingProduct(){
        $curDate = date("Y-m-d");
        $table = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        $list_hoan_ung_v1 = DB::table($table)
            ->join('products','id_product','=','products.id')
            ->where('status_transport','=','done')
            ->where('status_payment','=','done')
            ->where('status_kt','=','done')
            ->where('status_admin2','=','done')
            ->select(''.$table.'.*','products.*')
            ->addSelect(''.$table.'.id as id_order');

        $list_hoan_ung = $list_hoan_ung_v1->get();
        $sum_total_product = $list_hoan_ung_v1->sum('total_product');
        $sum_total_price = $list_hoan_ung_v1->sum('total_price');
        $sum_total_bonus = $list_hoan_ung_v1->sum('total_bonus');
        $product = Products::all();
        return view('user2.list_shipping_product',
            compact('list_hoan_ung','product','sum_total_product','sum_total_price','sum_total_bonus'));
    }

    public function detail_hoa_hong($id){
        $curDate = date("Y-m-d");
        $table = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        $product_name = Products::find($id)->name;
        $total_product = DB::table($table)
            ->where('id_product','=',$id)
            ->where('status_transport','=','done')
            ->where('status_payment','=','done')
            ->where('status_kt','=','done')
            ->where('status_admin2','=','done')
            ->sum('total_product');
        $total_price = DB::table($table)
            ->where('id_product','=',$id)
            ->where('status_transport','=','done')
            ->where('status_payment','=','done')
            ->where('status_kt','=','done')
            ->where('status_admin2','=','done')
            ->sum('total_price');
        $total_bonus = DB::table($table)
            ->where('id_product','=',$id)
            ->where('status_transport','=','done')
            ->where('status_payment','=','done')
            ->where('status_kt','=','done')
            ->where('status_admin2','=','done')
            ->sum('total_bonus');
        return view('user2.detail_hoa_hong',compact('total_product','total_bonus','total_price','product_name'));
    }

    public function hoan_ung(){
        $curDate = date("Y-m-d");
        $table = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';
        $list_hoan_ung_v1 = DB::table($table)
            ->join('products','id_product','=','products.id')
//            ->where('status_transport','=','done')
//            ->where('status_payment','=','wait')
            ->where('status_kt','=','wait')
            ->where('status_admin2','=','wait')
            ->select(''.$table.'.*','products.*')
            ->addSelect(''.$table.'.id as id_order');

        $list_hoan_ung = $list_hoan_ung_v1->get();
        $sum_total_product = $list_hoan_ung_v1->sum('total_product');
        $sum_total_price = $list_hoan_ung_v1->sum('total_price');
        $sum_total_bonus = $list_hoan_ung_v1->sum('total_bonus');
        $product = Products::all();
        return view('user2.list_hoan_ung',
            compact('list_hoan_ung','product','sum_total_product','sum_total_price','sum_total_bonus'));
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
            $check = Schema::hasTable($table1);
            if($check != true){
                $create_table = Schema::create($table1, function (Blueprint $tables) {
                    $tables->increments('id');
                    $tables->integer('id_product');
                    $tables->integer('total_product');
                    $tables->integer('id_user');
                    $tables->string('email_guest')->nullable();
                    $tables->string('phone_guest')->nullable();
                    $tables->integer('bonus_pr');
                    $tables->integer('total_price');
                    $tables->integer('total_bonus');
                    $tables->dateTime('time');
                    $tables->string('status_transport');
                    $tables->string('status_payment');
                    $tables->string('status_kt');
                    $tables->string('status_admin2');
                    $tables->timestamps();
                });
            }
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

    public function view_manage_goal(){
        $find_id_group = Auth::user()->group_id;
        $find_id_goal_sale = GoalSales::where('id_group','like','%'.$find_id_group.'%')->get();
        $arr_id_goal = [];
        foreach ($find_id_goal_sale as $value){
            array_push($arr_id_goal,$value->id_goal) ;
        }
        $list_goal = GoalProduct::whereIn('id',$arr_id_goal)->get();
        return view('user2.manage_goal',compact('list_goal'));
    }

    public function chi_tiet_muc_tieu_ban_hang($id){
        $total_goal = GoalProduct::find($id)->sl;
        $check_sl = GoalProduct::find($id)->sl;
        if($total_goal == null){
            $total_goal = GoalProduct::find($id)->dt;
        }

        $start_time = GoalProduct::find($id)->start_time;
        $end_time = GoalProduct::find($id)->end_time;

        $find_id_goal_sale = GoalSales::where('id_goal','=',$id)->get();
        foreach ($find_id_goal_sale as $value){
            $str_id_product = $value->id_product;
        }
        $arr_id_product = explode(',',$str_id_product);
        $list_product = Products::whereIn('id',$arr_id_product)->get();

        $arr_sl = [];
        $arr_dt = [];
        if(substr($start_time,5,2) === substr($end_time,5,2)){
            $name_table = 'spd_'.substr($start_time,5,2).substr($start_time,0,4).'s';
            foreach ($list_product as $key => $value){
                $arr_sl[$value->id] = DB::table($name_table)
                    ->where('id_user','=',Auth::id())
                    ->where('id_product','=',$value->id)
                    ->sum('total_product');
                $arr_dt[$value->id] = DB::table($name_table)
                    ->where('id_user','=',Auth::id())
                    ->where('id_product','=',$value->id)
                    ->sum('total_price');

            }
        }
        return view('user2.detail_muc_tieu_ban_hang',
            compact('list_product','arr_dt','arr_sl','total_goal','check_sl','start_time','end_time'));
    }

    public function view_manage_emulation(){
        $emulation_new = DB::table('emulations')->orderByDesc('id')->first();

        $list_emulation = DB::table('emulations')->orderByDesc('id')->get();
        return view('user2.manage_emulation',compact('emulation_new','list_emulation'));
    }

    public function view_list_emulation_detail($id){
        $emulation_detail = Emulation::find($id);

        $emu_product = EmulationProducts::where('id_emulation','=',$id)->get();
        foreach ($emu_product as $value){
            $id_product = $value->id_product;
        }
        $arr_id = explode(',',$id_product);
        $list_product = Products::whereIn('id',$arr_id)->get();

        $curDate = date("Y-m-d");
        $table1 = 'spd_'.substr($curDate,5,2).substr($curDate,0,4).'s';

        $id_user = DB::table($table1)->select('id_user')->groupBy('id_user')->get();

        foreach ($id_user as $value) {
            foreach ($list_product as $key => $values) {
                $arr[$value->id_user][$values->id] = DB::table($table1)
                    ->where('id_product', '=', $values->id)
                    ->where('id_user', '=', $value->id_user)
                    ->sum('total_product');
            }
        }

        foreach ($arr_id as $value_id_pdu){
            $total = TotalProductEmulation::where('id_emu_pdu','=',$id)->where('id_product','=',$value_id_pdu)->get();
            foreach ($total as $value_tt){
                $total_tt[$value_id_pdu] = $value_tt->total;
            }
            foreach ($total as $value_tt){
                $total_rv[$value_id_pdu] = $value_tt->revenue;
            }
        }

        // $key - id user
        // $key_1 - id product
        // $value2 - tong so san pham ban
//        $result = [];
//        foreach ($arr as $key => $value1){
//            foreach ($value1 as $key_1 => $value2){
//                if($value2 >= $total_tt[$key_1] && $value2 >= $total_rv[$key_1]){
//                    $result[$key] = $value2;
//                }
//            }
//        }

        $list_name_user = DB::table('users')->select('id','last_name','email')->get();
//        dd($list_name_user);
        return view('user2.view_list_emulation_detail',compact('emulation_detail','list_product','list_name_user'));
    }

    public function viewAnalysisEmulation(){
        $list_emulation = EmulationProducts:: join('emulations','emulations.id','=','emulation_products.id_emulation')->get();
        $arr = [];
        $stt_arr = [];
        $sl_auth = [];
        $dt_auth = [];
        foreach ($list_emulation as $key => $value_detail){
                $str_rs = "select * from (select a.id_user, sum(a.total_product) as b, sum(a.total_price) as c from spd_092020s as a
                where a.id_product IN (".$value_detail->id_product.") group by a.id_user
                ) as d
                where d.b > ".$value_detail->total." and d.c > ".$value_detail->revenue."
                order by c desc limit 10";

                $query = DB::select($str_rs);
                $arr[$value_detail->name] = $query;

                $str_rs_stt = "select * from (select a.id_user, sum(a.total_product) as b, sum(a.total_price) as c from spd_092020s as a
                where a.id_product IN (".$value_detail->id_product.") group by a.id_user
                ) as d
                order by c desc";

                $query_stt  = DB::select($str_rs_stt);
                $i = 0;
                $x = 0;
                foreach ($query_stt as $value_stt){
                    if($value_stt->id_user == Auth::id()) {
                        if($i == 0){
                            $x = 1;
                        }
                        break;
                    }
                    $x++;
                }


                $sl_dt_auth = "select * from (select a.id_user, sum(a.total_product) as b, sum(a.total_price) as c from spd_092020s as a
                where a.id_product IN (".$value_detail->id_product.") group by a.id_user
                ) as d
                order by c desc";

                $query_sl_dt_auth  = DB::select($sl_dt_auth);
                foreach ($query_sl_dt_auth as $value){
                    if($value->id_user == Auth::id()){
                        $sl_auth[$value_detail->name] = $value->b;
                        $dt_auth[$value_detail->name] = $value->c;
                    }
                }

                $stt_arr[$value_detail->name] = $x;
        }
        $name = User::select('id','last_name','email')->get();
        return view('user2.analys_emulation',compact('arr','name','stt_arr','sl_auth','dt_auth'));
    }

    public function viewAnalysisGoal(){
        $find_id_group = Auth::user()->group_id;
        $find_id_goal_sale = GoalSales::where('id_group','like','%'.$find_id_group.'%')->get();
        $arr_id_goal = [];
        foreach ($find_id_goal_sale as $value){
            array_push($arr_id_goal,$value->id_goal) ;
        }
        $list_goal = GoalProduct::whereIn('id',$arr_id_goal)->get();
        $sl_rq = [];
        $dt_rq = [];
        foreach ($list_goal as $values){
            $sl_rq[$values->id] = $values->sl;
            $dt_rq[$values->id] = $values->dt;
        }

        $arr_result_sl= [];
        $arr_result_dt= [];
        foreach ($list_goal as $value_goal){
            $find_id_goal_sale = GoalSales::where('id_goal','=',$value_goal->id)->get();
            foreach ($find_id_goal_sale as $value){
                $str_id_product = $value->id_product;
            }
            $sl_goal = GoalProduct::find($value_goal->id)->sl;
            $dt_goal = GoalProduct::find($value_goal->id)->dt;
            $start_time = GoalProduct::find($value_goal->id)->start_time;
            $arr_id_product = explode(',',$str_id_product);
            $list_product = Products::whereIn('id',$arr_id_product)->get();

            $name_table = 'spd_'.substr($start_time,5,2).substr($start_time,0,4).'s';

            $result = [];
            $sl_con_thieu = $sl_goal;
            $dt_con_thieu = $dt_goal;
            foreach ($list_product as $key => $value){
                $arr_sl = DB::table($name_table)
                    ->where('id_user','=',Auth::id())
                    ->where('id_product','=',$value->id)
                    ->sum('total_product');
                $arr_dt = DB::table($name_table)
                    ->where('id_user','=',Auth::id())
                    ->where('id_product','=',$value->id)
                    ->sum('total_price');
                if ($sl_goal == null){
                    $result[$value->name] = $arr_dt ;
                    $dt_con_thieu = $dt_con_thieu - $arr_dt;
                }
                if($dt_goal == null){
                    $result[$value->name] = $arr_sl ;
                    $sl_con_thieu = $sl_con_thieu - $arr_sl;
                }
            }
            if($dt_con_thieu > 0){
                $result['Doanh Thu Còn Thiếu'] = $dt_con_thieu;
            }
            if($sl_con_thieu > 0){
                $result['Sản Lượng Còn Thiếu'] = $sl_con_thieu;
            }

            $arr_result_sl[$value_goal->id] = $result;
        }
        $list_detail_goal = GoalProduct::all();
        return view('user2.analys_goal',compact('arr_result_sl','list_detail_goal'));
    }

    public function notification(){
        $notification = Notification::all();
        return view('user2.notification',compact('notification'));
    }
}
