<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Club;
use DB;

class AdminRegisterController extends Controller
{
    /*
     * ---------------------------
     * Registrar a Administradores, aquí están los métodos necesarios para las validaciones
     * del formulario y para el registro de los mismos en la base de datos
     * ---------------------------
     * */

    /*
     * Create una nueva instancia del controlador
     * */
    protected $redirectTo='/login';

    public function _construct(){
        $this->middleware('guest');
    }

    /*
     * Return formulario de registro de Administradores
     * */

    public function showAdminRegister($club){
        $club = Club::where('id',$club)->first();
        return view('auth.adminRegister')->with(compact(['club']));
    }

    public function checkEmail(Request $request){
       $username = Admin::Where('username','=',$request->username)->exists();
       return response()->json($username);
    }

    public function registerAdmin(Request $request){

        $admin = new Admin();
        $admin->email = $request->input('admin-email');
        $admin->username = $request->input('admin-username');
        $admin->password = bcrypt($request->input('admin-password'));
        $admin->club_id =  $request->input('club');
        $admin->save();

        DB::table('valid_admins')->where('club',$admin->club_id)->delete();

        return response()->json(['username' => $admin->username,'password'=>$admin->password]);
    }
}
