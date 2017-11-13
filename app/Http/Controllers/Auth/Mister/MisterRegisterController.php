<?php

namespace App\Http\Controllers\Auth\Mister;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mister;
use App\Models\Team;

class MisterRegisterController extends Controller{

    /*
     * ---------------------------
     * Registrar a Entrenadores, aquí están los métodos necesarios para las validaciones
     * del formulario y para el registro de los mismos en la base de datos
     * ---------------------------
     * */

    /*
     * Create una nueva instancia del controlador
     * */

    public function _construct(){
        $this->middleware('guest');
    }

    /*
     * Return formulario de registro de entrenadores
     * */

    public function showMisterRegister(){
        return view('auth.misterRegister');
    }

    /*
     * Crear y guardar un nuevo Entrenador
     * */
    public function registerMister(Request $request){

        /*
         * ---------------------------------
         * Validaciones a nivel de servidor
         * --------------------------------
         * */
        $this->validate($request,[
            'name' => 'required|max:100',
            'email'=> 'required|email|unique:misters',
            'password' => 'required|min:6|confirmed',
            'team_name' => 'required|exists:teams,name',
            'photo' => 'image|max:4096'
        ]);


        /*
         * ---------------------------------
         * Recoger datos del formulario y tratamiento de ellos para crear un Entrenador.
         * ---------------------------------
         * */
        $mister = new Mister([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>bcrypt($request->input('password')),
        ]);

        /*
         * Controles de Imagen
         * */
        if($request->hasFile('photo')){
            if($request->file('photo')->isValid()){
                $photo = $request->file('photo');
                $path = $photo->storeAs('misters',$mister->id.'.'.$photo->guessExtension());
                $mister->file=$path;
            }
        }
        else{
            $mister->file = url("images/avatars/Maestro_Tortuga.png");
        }

        $team =$request->input('team_name');

        $team_id = Team::where('name',$team)->first();

        $mister-> team_id = $team_id;

        /*
         * Guardar Entrenador en la base de datos
         * */

        $mister->save();

        /*
         *Redirigir al home
         **/

        return redirect('/home');
    }
}