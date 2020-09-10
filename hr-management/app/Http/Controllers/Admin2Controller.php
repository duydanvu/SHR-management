<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin2Controller extends Controller
{
    public function index(){
        return view('admin2.create_acc');
    }

    public function group(){
        return view('admin2.group_manage');
    }

    public function view_information(){
        return view('admin2.update_information_auth');
    }

    public function addUserToGroup(){
        return view('admin2.add_user_to_group');
    }

    public function viewHanMuc(){
        return view('admin2.han_muc_thu_tien');
    }

    public function lockAccUser(){
        return view('admin2.lock_unlock_account');
    }

    public function addASMToGroup(){

    }

}
