<?php

namespace App\Http\Controllers;


use App\Models\User;

class LoginController extends Controller
{
    public function view(){
        $users = User::all();

        return view('login' ,['users'=> $users]);
    }
}
