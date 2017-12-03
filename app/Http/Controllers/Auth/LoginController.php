<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Facades\Lang;

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
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function username(){
        return 'username';
    }

    public function authenticate(Request $request){


        $this->validate($request,[
           'username' => 'required',
           'password' => 'required'
        ]);
//
        if(Auth::guard('player')->attempt(['username'=>$request->username , 'password'=>$request->password])){
            return response()->redirectToRoute('player.home');
        }
        if(Auth::guard('admin')->attempt(['username'=>$request->username , 'password'=>$request->password])){
            return response()->redirectToRoute('admin.home');
        }
        if(Auth::guard('mister')->attempt(['username'=>$request->username , 'password'=>$request->password])){
            return response()->redirectToRoute('mister.home');
        }
        if(Auth::guard('tutor')->attempt(['username'=>$request->username , 'password'=>$request->password])){
            return response()->redirectToRoute('tutor.home');
        }
        if(Auth::guard('superAdmin')->attempt(['username'=>$request->username,'password'=>$request->password])){
            return response()->redirectToRoute('superAdmin.home');
        }
        if($request->ajax()){
            return response()->json();
        }
        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        if ( ! Player::all()->where('username', $request->username)->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => Lang::get('auth.username'),
                ]);
        }

        if ( ! Player::all()->where('username', $request->username)->where('password', bcrypt($request->password))->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    'password' => Lang::get('auth.password'),
                ]);
        }

    }

}
