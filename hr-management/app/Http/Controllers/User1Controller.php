<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;

class User1Controller extends Controller
{
    public function lockAccUser(){
        $id_group = Group::where('manager','like','%'.\Auth::id().'%')->get();

        foreach ($id_group as $key=>$value){
            if($key == 0){
                $user1 = User::where('group_id','=',$value->id)->where('activation_key','<>',null);
            }
            $user = User::where('group_id','=',$value->id)
                ->where('activation_key','<>',null)
                ->union($user1);
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
                    $user1 = User::where('group_id','=',$value->id)
                        ->where('activation_key','<>',null);
                }
                $user = User::where('group_id','=',$value->id)
                    ->where('activation_key','<>',null)
                    ->union($user1);
            }
        }else{
            foreach ($id_group as $key=>$value){
                if($key == 0){
                    $user1 = User::where('group_id','=',$value->id)
                        ->where('last_name','like','%'.$request->name_user.'%')
                        ->where('activation_key','<>',null);
                }
                $user = User::where('group_id','=',$value->id)
                    ->where('activation_key','<>',null)
                    ->where('last_name','like','%'.$request->name_user.'%')
                    ->union($user1);
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
        return view('user1.index_products_decentralization');
    }
}
