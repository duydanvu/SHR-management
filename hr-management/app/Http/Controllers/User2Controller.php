<?php

namespace App\Http\Controllers;

use App\Products;
use App\Supplier;
use App\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
