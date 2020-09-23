<?php

namespace App\Http\Controllers;

use App\Group;
use App\Products;
use App\User;
use App\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class User1Controller extends Controller
{
    public function lockAccUser(){
        $id_group = Group::where('manager','like','%'.\Auth::id().'%')->get();

        foreach ($id_group as $key=>$value){
            if($key == 0){
                $user = User::where('group_id','=',$value->id)->where('activation_key','<>',null);
            }
            $str_group = [];
            foreach ($id_group as $key=>$value){
                array_push($str_group,$value->id);

            }
            //$str_group = "[".$str_group."]";
            $user = DB::table('users')->whereIn('group_id',$str_group)->where('activation_key','<>',null);
        }
        try {
            $list_user = $user->get();
        }catch (\ErrorException $ex){
            $list_user = [];
        }
        return view('user1.lock_unlock_account')->with(['list_user'=>$list_user]);
    }

    public function search_user_with_user1(Request $request){
        $id_group = Group::where('manager','like','%'.\Auth::id().'%')->get();

        if ($request->name_user == null){
            foreach ($id_group as $key=>$value){
                if($key == 0){
                    $user = User::where('group_id','=',$value->id)
                        ->where('activation_key','<>',null);
                }
                if($key == 1){
                    $user = User::where('group_id','=',$value->id)
                        ->where('activation_key','<>',null)
                        ->union($user);
                }
                if($key > 1){
                    $user = User::where('group_id','=',$value->id)
                        ->where('activation_key','<>',null)
                        ->union($user);
                }
            }
        }else{
            foreach ($id_group as $key=>$value){
                if($key == 0){
                    $user1 = User::where('group_id','=',$value->id)
                        ->where('last_name','like','%'.$request->name_user.'%')
                        ->where('activation_key','<>',null);
                }
                if($key == 1){
                    $user = User::where('group_id','=',$value->id)
                        ->where('activation_key','<>',null)
                        ->where('last_name','like','%'.$request->name_user.'%')
                        ->union($user1);
                }
                if($key > 1){
                    $user = User::where('group_id','=',$value->id)
                        ->where('activation_key','<>',null)
                        ->where('last_name','like','%'.$request->name_user.'%')
                        ->union($user);
                }
            }
        }
        $result = null;

        foreach ($user->get() as $key=>$value){
            $result .= '<tr>';
            $result .= '<td>'.($key+1).'</td>';
            $result .= '<td><a href="'.route('view_lock_account',['id'=>$value->id]).'" data-remote="false"
                                   data-toggle="modal" data-target="#modal-admin-action-update" class="btn dropdown-item">
                                   <i class="fas fa-lock"> Khóa Tài Khoản</i></a></td>';
            $result .= '<td>'.($value->last_name).'</td>';
            $result .= '<td>'.($value->email).'</td>';
            $result .= '<td>'.($value->dob).'</td>';
            $result .= '<td>'.($value->phone).'</td>';
            $result .= '<td> Đang hoạt động </td>';
            $result .= '</tr>';
        }
        return $result;
    }
    public function phanQuyenSanPham(){
        $id_group = Group::where('manager','like','%'.\Auth::id().'%')->get();
        foreach ($id_group as $key=>$value){
            if($key == 0) {
                $id_product = UserProduct::where('id_group', '=', $value->id)
                ->select('id_product','id_group')
                ->groupBy('id_product','id_group');
            }
            $id_product = UserProduct::where('id_group', '=', $value->id)
                ->select('id_product','id_group')
                ->groupBy('id_product','id_group')
                ->union($id_product);
        }
        foreach ($id_product->get() as $key=> $values){
            if($key == 0){
                $product = Products::where('id','=',$values->id_product);
            }
            if($key == 1){
                $product = Products::where('id','=',$values->id_product)->union($product);
            }
            if($key > 1){
                $product = Products::where('id','=',$values->id_product)->union($product);
            }
        }
        $list_product = $product->get();
        return view('user1.index_products_decentralization',compact('list_product'));
    }

    public function view_user_with_sale_product($id){
        $id_group = Group::where('manager','like','%'.\Auth::id().'%')->get();
        foreach ($id_group as $key => $value){
            if($key == 0){
                $user = UserProduct::join('users','users.id','=','user_products.id_user')
                    ->where('users.activation_key','=','active')
                    ->where('id_group','=',$value->id)
                    ->where('id_product','=',$id)
                    ->select('user_products.*','users.last_name','users.email');
            }
            $user = UserProduct::join('users','users.id','=','user_products.id_user')
                ->where('users.activation_key','=','active')
                ->where('id_group','=',$value->id)
                ->where('id_product','=',$id)
                ->select('user_products.*','users.last_name','users.email')
                ->union($user);

        }
        $list_user = $user->get();
        $list_group = Group::all();
        return view('user1.list_user_sale_product',compact('list_user','list_group','id'));
    }

    public function updateUserSaleProduct($id){
        $id_user_product = UserProduct::find($id);
        if($id_user_product->status == 'active'){
            $update_user = DB::table('user_products')->where('id', '=', $id)
                ->update([
                    'status' => 'stop',
                ]);
        }elseif($id_user_product->status == 'stop'){
            $update_user = DB::table('user_products')->where('id', '=', $id)
                ->update([
                    'status' => 'active',
                ]);
        }
        $notification = array(
            'message' => 'Thay đổi thành công!',
            'alert-type' => 'success'
        );
        return Redirect::back()->with($notification);
    }
}
