<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('admin')->check()){
            return view('admin.home');
        }
        if(Auth::guard('player')->check()){
            return view('player.home');
        }
        if(Auth::guard('mister')->check()){
            return view('mister.home');
        }
        if(Auth::guard('tutor')->check()){
            return view('tutor.home');
        }
        else{
            return view('welcome');
        }
    }
}
