<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function _construct(){
        $this->middleware('guest');
    }

    /*
     * Return formulario de registro de Administradores
     * */

    public function showAdminRegister(){
        return view('auth.adminRegister');
    }
}
