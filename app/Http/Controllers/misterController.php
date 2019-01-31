<?php

namespace App\Http\Controllers;

use App\Models\Match;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Player;
use App\Models\PlayerMatch;
use MaddHatter\LaravelFullcalendar\Calendar;
use Auth;

class misterController extends Controller{


    //HOME
    public function home(){
        $mister = Auth::guard('mister')->user();
        return view('mister.home',compact('mister'));
    }

    //PERFIL
    public function showProfile(){
        $mister = Auth::guard('mister')->user();
        return view('misterProfile',compact('mister'));
    }

    //CALENDARIO
    public function calendar(){
        $mister = Auth::guard('mister')->user();
        return view('mister.calendar',compact('mister'));
    }


    //TACTICAS
    public function tactica(){
        $mister = Auth::guard('mister')->user();
        return view('mister.tacticas',compact('mister'));
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
