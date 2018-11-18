<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mister;
use App\Models\Team;
use App\Models\League;
use MaddHatter\LaravelFullcalendar\Calendar;
use Auth;

class misterController extends Controller
{
    //HOME
    public function home(){
        return view('mister.home');
    }

    //PERFIL
    public function showProfile($mister){
        $m = Mister::all()->where('id', '=', $mister)->first();
        $team = Team::all()->where('id','=',$m->team->id)->first();
        $t=$team->name;
        $league = League::all()->where('id',$team->league->id)->first()->name;
        $stats= $m->stats;
        if($stats->count()<1)
            $lastTeam='--';
        else
            $lastTeam = $stats->last()->get()->team;

        return view('misterProfile',with(compact(['m','t','league','lastTeam'])));
    }

    public function tactica(){
        $mister = Auth::guard('mister')->user();
        return view('mister.tacticas',with(compact('mister')));
    }

    //HERRAMIENTA MINUTOS
    public function herramientaMinutos(){
        $mister = Auth::guard('mister')->user();
        return view('vistasHerramienta.includes.inicio');
    }
    public function herramientaPartido(){
        return view('vistasHerramienta.includes.partido');
    }
    //CALENDARIO PARTIDOS
    public function getMisterCalendar(){
        $partidos = $this->getMatchs();
        $calendar = \Calendar::addEvents($partidos)->setOptions([
            'displayEventTime' =>false,
            'timeFormat'=> 'HH:mm',
            'fixedWeekCount'=>false,
            'dayNamesShort' =>['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado']
        ])->setCallbacks([
            'eventClick'=>'function(calEvent){
                if(calEvent.id.includes("e")){
                    window.alert("edit");
                }else{
                    window.location.href="match/"+calEvent.id+"/";
                }
            }',
        ]);
        return $calendar;
    }

    //Partidos del entrenador
    public function getMatchs(){
        $mister = Auth::guard('mister')->user();
        $matchs= collect([]);
        $partidos = $mister->team->matchs;
        foreach($partidos as $partido){
            $match = Calendar::event(
                $partido->title,//Titulo
                false,//¿Dia Entero?
                $partido->start,//INICIO
                $partido->end,//FIN
                $partido->id,//EVENT ID
                [
                    'editable' => true,
                ]
            );
            $matchs->push($match);
        }
        return $matchs;
    }

}
