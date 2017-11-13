<?php

namespace App\Http\Controllers\Auth\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TutorRegisterController extends Controller
{
    /*
     * ---------------------------
     * Registrar a Tutores, aquí están los métodos necesarios para las validaciones
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
     * Return formulario de registro de Tutores
     * */

    public function showTutorRegister(){
        return view('auth.tutorRegister');
    }


}
