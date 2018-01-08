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

    public function showMisterRegister($team){
        return view('auth.misterRegister')->with(compact(['team']));
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
        $messages =[
            'email.email' => 'Mete un email válido imbecil',
            'username.min' => 'Mete un usuario más grande zopenco, minimo 6!',
            'email.exists' => 'Parece que usted no está invitado para ser entrenador del club!',
            'username.unique' => 'Ups! Hay otra persona que ya ha pensado este nombre de usuario, por favor, eliga otro',
            'password.alpha_num' => 'Introduce una contraseña que solamente contenga letras y números por favor. Gracias'
        ];
        $this->validate($request,[
            'name' => 'required|min:3|max:190',
            'email' => 'required|email|max:190|unique:misters,email|exists:valid_misters,email',
            'username' => 'required|min:6|max:190|unique:misters,username',
            'password' => 'required|min:6|max:190|alpha_num'
        ],$messages);


        /*
         * ---------------------------------
         * Recoger datos del formulario y tratamiento de ellos para crear un Entrenador.
         * ---------------------------------
         * */
        $mister = new Mister([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>bcrypt($request->input('password')),
            'username' => $request->input('username')
        ]);
        $tName = $request->input('team');
        $team = Team::where('name',$tName)->first();
        $mister->team_id = $team->id;
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

        /*
         * Guardar Entrenador en la base de datos
         * */

        $mister->save();

        //RELATIONSHIPS
        $mister->team()->associate($team);
        $team->mister()->save($mister);

        /*
         *Redirigir al home
         **/

        return view('mister.home');
    }
}