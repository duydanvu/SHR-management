<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User1Controller extends Controller
{
    public function lockAccUser(){
        return view('user1.lock_unlock_account');
    }

    public function view_information(){
        return view('user1.update_information_auth');
    }
}
