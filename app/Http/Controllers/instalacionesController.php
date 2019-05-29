<?php

namespace App\Http\Controllers;

use App\Models\Instalacion;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class instalacionesController extends Controller
{
    //
    public function create(Request $request){
        $admin = Auth::guard('admin')->user();
        $club = $admin->club;
        $instalacion = new Instalacion();
        $instalacion->name = $request->input('instalacion-name');
        $instalacion->tipo = $request->input('instalacion-tipo');
        $instalacion->terreno = $request->input('instalacion-terreno');

        $club->instalaciones()->save($instalacion);
        $instalaciones = $club->instalaciones;

        $view = view('admin.instalaciones',compact(['instalaciones','admin']));
        if($request->ajax()){
            $sections = $view->renderSections();
            return $view->renderSections()['content'];
        }
        return $view;
    }

    public function delete(Request $request){
        $id = $request->input('id');
        DB::Table('instalaciones')->where('id',$id)->delete();
        return 'Instalacion eliminada correctamente';
    }


    /*-----------------------------------------------
    * ----------------- RESERVAS  -------------------
    * -----------------------------------------------*/
    public function createReserva(Request $request){
        $admin = Auth::guard('admin')->user();
        $horaInicio = $request->input('horaInicio-reserva');
        $horaFin = $request->input('horaFin-reserva');
        $tiempo = Carbon::parse($horaFin)->diffInMinutes($horaInicio);
        $team_id = null;

        if($request->has('team-reserva')){
            $team_id = $request->input('team-reserva');
        }

        $reserva = new Reserva();
        $reserva ->uso = $request->input('uso-reserva');
        $reserva->fecha = Carbon::createFromFormat('d/m/Y H:i',$request->input('dia-reserva').' '.$horaInicio);
        $reserva->tiempo = $tiempo;
        $reserva->team_id = $team_id;
        $reserva->instalacion_id = $request->input('instalacion');
        $reserva->save();


        return $reserva;
    }
}
