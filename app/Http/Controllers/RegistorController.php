<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegistorController extends Controller
{
    public function view(){

        return view('registor');
    }
}
