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
    public function registerAdmin(Request $request){
        $messages =[
            'email.exists' => 'Parece que usted no está invitado para ser administrador del club!',
            'username.unique' => 'Ups! Hay otra persona que ya ha pensado este nombre de usuario, por favor, eliga otro',
            'password.alpha_num' => 'Introduce una contraseña que solamente contenga letras y números por favor. Gracias'
        ];
        $this->validate($request,[
            'name' => 'required|min:3|max:190',
            'email' => 'required|email|max:190|unique:admin_clubs,email|exists:valid_admins,email',
            'username' => 'required|min:6|max:190|unique:admin_clubs,username',
            'password' => 'required|min:6|max:190|alpha_num'
        ],$messages);

        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->username = $request->input('username');
        $admin->password = bcrypt($request->input('password'));
        $cName = $request->input('club');
        $club = Club::where('name',$cName)->first();
        $admin->club_id = $club->id;
        $admin->save();

        $admin->club()->associate($club);
        $club->admin()->save($admin);

        return view('admin.home');
    }
}
