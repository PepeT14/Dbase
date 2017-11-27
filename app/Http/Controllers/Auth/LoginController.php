<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     *

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){

        $this->validate($request,[
           'email' => 'required|email',
           'password' => 'password|min:6'
        ]);

        if(Auth::guard('player')->attempt(['email'=>$request->email , 'password'=>$request->password])){
            return response()->redirectToRoute('player.home');
        }
        if(Auth::guard('admin')->attempt(['email'=>$request->email , 'password'=>$request->password])){
            return response()->redirectToRoute('admin.home');
        }
        if(Auth::guard('superAdmin')->attempt(['email'=>$request->email , 'password'=>$request->password])){
            return response()->redirectToRoute('superAdmin.home');
        }
        if(Auth::guard('mister')->attempt(['email'=>$request->email , 'password'=>$request->password])){
            return response()->redirectToRoute('mister.home');
        }
        if(Auth::guard('tutor')->attempt(['email'=>$request->email , 'password'=>$request->password])){
            return response()->redirectToRoute('tutor.home');
        }
        return back();
    }
}
