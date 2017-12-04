<?php

namespace App\Http\Controllers\Auth\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\League;

class SuperAdminRegisterController extends Controller
{
    /*
     * ---------------------------
     * Registrar a super administradores, aquí están los métodos necesarios para las validaciones
     * del formulario y para el registro de los mismos en la base de datos
     * ---------------------------
     * */

    /*
     * Create una nueva instancia del controlador
     * */


    protected $redirectTo = 'superAdmin/home';

    public function _construct(){
        $this->middleware('guest');
    }

    /*
     * Return formulario de registro de
     * */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);
    }

    public function showSuperAdminRegister(){
        return view('auth.superAdminRegister');
    }
    public function create(Request $request){
        $sa = new SuperAdmin([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);
        $sa->save();

        $clubs = Club::all()->get();

        $states = collect([]);
        $leagues = League::all()->get();
        foreach($leagues as $league){
            if(!$states->contains($league->state)){
                $states->push($league->state);
            }
        }

        return redirect('superAdminRegister.home')->with(compact(['clubs','states','leagues']));
    }

}