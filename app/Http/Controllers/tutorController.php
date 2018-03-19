<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tutorController extends Controller
{
    //
    public function home(){
        return view ('tutor.home');
    }
}
