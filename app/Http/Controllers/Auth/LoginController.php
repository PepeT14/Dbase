<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Facades\Lang;
use DB;

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
     * /


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
    public function showLoginForm(){
        return view('auth.login');
    }

    public function showLoginSAForm(){
        return view('auth.loginSA');
    }

    public function authenticateSA (Request $request){
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);
        if(Auth::guard('superAdmin')->attempt(['username'=>$request->username,'password'=>$request->password])){
            return response()->redirectToRoute('superAdmin.home');
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function authenticate(Request $request){

        if($request->ajax()){
            $username = $request->input('username');

            if(DB::table('admin_clubs')->where('username','=',$username)->count()){
                if(Auth::guard('admin')->attempt(['username'=>$request->username , 'password'=>$request->password])){
                    return response()->json(['url'=>'admin/home']);
                }
                $errors = 'Contraseña incorrecta';
                return response()->json(['password'=>$errors]);
            }
            else if(DB::table('misters')->where('username',$username)->count()>0){
                if(Auth::guard('admin')->attempt(['username'=>$request->username , 'password'=>$request->password])){
                    return response()->json(['url'=>'mister/home']);
                }
                $errors = 'Contraseña incorrecta';
                return response()->json(['password'=>$errors]);
            }
            else{
                return response()->json(['usuario'=>'Este usuario no existe en nuestra Base de datos.']);
            }
            /*if(DB::table('players')->where('username',$username)->count()>0){
            if(Auth::guard('admin')->attempt(['username'=>$request->username , 'password'=>$request->password])){
                return response()->redirectToRoute('player.home');
            }else{
                $errors = 'Contraseña incorrecta.';
                return response()->json(['contraseña'=>$errors]);
            }
            if(DB::table('tutors')->where('username',$username)->count()>0){
                if(Auth::guard('admin')->attempt(['username'=>$request->username , 'password'=>$request->password])){
                    return response()->redirectToRoute('tutor.home');
                }else{
                    $errors = 'Contraseña incorrecta.';
                    return response()->json(['contraseña'=>$errors]);
                }
            }*/
        }
        return $this->sendFailedLoginResponse($request);
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

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
