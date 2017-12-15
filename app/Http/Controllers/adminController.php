<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    //Home
    public function home(){
        return view('admin.home');
    }
}
