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
}
