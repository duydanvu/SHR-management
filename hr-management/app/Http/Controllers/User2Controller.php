<?php

namespace App\Http\Controllers;

use App\Products;
use App\Supplier;
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
            $product = Products::find($request['txtProductID']);
            if($product->hh_default != null){
                $create_sell_product = DB::table($table)->insertGetId([
                    'id_product'=> $request['txtProductID'],
                    'id_user'=> $id_Auth,
                    'total_product'=>$request['totalProduct'],
                    'bonus_pr'=> $product->hh_default,
                    'total_price'=> $product->price_sale * $request['totalProduct'],
                    'total_bonus'=> $product->hh_default * $request['totalProduct'],
                    'time'=> $curDateTime,
                ]);
            }elseif($product->hh_percent != null){
                $create_sell_product = DB::table($table)->insertGetId([
                    'id_product'=> $request['txtProductID'],
                    'id_user'=> $id_Auth,
                    'total_product'=>$request['totalProduct'],
                    'bonus_pr'=> $product->hh_percent,
                    'total_price'=> $product->price_sale * $request['totalProduct'],
                    'total_bonus'=> $product->price_sale * $request['totalProduct'] * $product->hh_percent / 100,
                    'time'=> $curDateTime,
                ]);
            }else{
                $notification = array(
                    'message' => 'Sản phẩm không phù hợp hoặc đã hết!',
                    'alert-type' => 'error'
                );
                return Redirect::back()->with($notification);
            }

//            if(!is_numeric($create_pdu)){
//                $notification = array(
//                    'message' => 'Kiểm tra lại thông tin ',
//                    'alert-type' => 'error'
//                );
//                return Redirect::back()->with($notification);
//            }else{
//                $insert_emulation_product = DB::table('goal_sales')->insert([
//                    'id_goal'=>$create_pdu,
//                    'id_product'=>null,
//                    'id_group'=>null,
//                ]);
//            }
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
}
