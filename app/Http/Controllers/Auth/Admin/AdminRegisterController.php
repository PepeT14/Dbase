<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Club;
use Auth;
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
        return view('auth.adminRegister')->with(compact(['club']));
    }

    public function checkEmail(Request $request){
       $username = Admin::Where('username','=',$request->username)->exists();
       return response()->json($username);
    }

    public function registerAdmin(Request $request){
        $messages =[
            'admin-email.exists' => 'Parece que usted no está invitado para ser administrador del club!',
            'admin-username.unique' => 'Ups! Hay otra persona que ya ha pensado este nombre de usuario, por favor, eliga otro'
        ];
        $this->validate($request,[
            'admin-email' => 'required|email|max:190|unique:admin_clubs,email|exists:valid_admins,email',
            'admin-username' => 'required|min:6|max:190|unique:admin_clubs,username',
            'admin-password' => 'required|min:6|max:190'
        ],$messages);

        $admin = new Admin();
        $admin->email = $request->input('admin-email');
        $admin->username = $request->input('admin-username');
        $admin->password = bcrypt($request->input('admin-password'));
        $cName = $request->input('club');
        $club = Club::all()->where('name',$cName)->first();
        $admin->club_id = $club->id;
        $admin->save();

        $admin->club()->associate($club);
        $club->admin()->save($admin);

        return response()->json([
            'url' => '/'
        ]);
    }
}
