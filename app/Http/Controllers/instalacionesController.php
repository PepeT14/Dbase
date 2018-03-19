<?php

namespace App\Http\Controllers;

use App\Models\Instalacion;
use Illuminate\Http\Request;
use Auth;

class instalacionesController extends Controller
{
    //
    public function create(Request $request){
        $club = Auth::guard('admin')->user()->club;
        $instalacion = new Instalacion();
        $instalacion->name = $request->input('name');
        $instalacion->tipo = $request->input('tipo');
        $instalacion->terreno = $request->input('terreno');

        $club->instalaciones()->save($instalacion);
        return redirect()->action('adminController@instalaciones');
    }
}
