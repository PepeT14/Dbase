<?php

namespace App\Http\Controllers\Auth\Player;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayerRegisterController extends Controller
{
    /*
     * ---------------------------
     * Registrar a Jugadores, aquí están los métodos necesarios para las validaciones
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
     * Return formulario de registro de Jugadores
     * */

    public function showPlayerRegister(){
        return view('auth.playerRegister');
    }
}
