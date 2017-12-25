<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class misterController extends Controller
{
    //HOME
    public function home(){
        return view('mister.home');
    }
}
