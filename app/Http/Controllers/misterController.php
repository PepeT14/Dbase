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

    public function tactica(){
        $mister = Auth::guard('mister')->user();
        return view('mister.tacticas',compact('mister'));
    }


    public function addMatch(Request $request){
        $mister = Auth::guard('mister')->user();

        $this->validate($request,[
            'fecha-partido' =>'required|date',
            'hora-partido' => 'required',
            'jornada-partido' => 'required'
        ]);

        $match = new Match();
        $match->jornada = $request->input('jornada-partido');
        $match->title = 'Partido del '.$mister->team->name.'. Jornada '.$request->input('jornada-partido');
        $fecha = $request->input('fecha-partido');
        $hora = $request->input('hora-partido');
        $match->start = Carbon::createFromFormat('Y-m-d H:i', $fecha.$hora);
        $match->league()->associate($mister->team->league);
        $match->save();

        if($request->has('alineacion')){
            $titulares = collect($request->input('alineacion.titulares'));
            $suplentes = collect($request->input('alineacion.suplentes'));
            foreach($titulares as $titular){
                $player = Player::Where('id',collect($titular)->get('id'))->first();
                $match->players()->attach($player,['minutes'=>0,'summoned' =>1,'playing'=>1]);
            }
            forEach($suplentes as $suplente){
                $player = Player::Where('id',collect($suplente)->get('id'))->first();
                $match->players()->attach($player,['minutes'=>0,'summoned' =>1,'playing'=>0]);
            }
        }
        if($request->has('local')){
            $quality = 'local';
        }else{
            $quality = 'visitante';
        }
        $match->teams()->attach($mister->team,['quality' => $quality]);
        return 'partido/'.$match->id;
    }

    //EQUIPO
    public function startPartido($match){
        $mister = Auth::guard('mister')->user();
        $match = Match::find($match);
        return view('mister.partido',compact(['match','mister']));
    }

    public function showEquipo(){
        $mister = Auth::guard('mister')->user();
        return view('mister.equipo',with(compact('mister')));
    }

    public function addPlayer(Request $request){

        $this->validate($request,[
            'player-name' =>'required|string',
            'player-position' =>'string',
            'player-birthday' =>'required|date',
        ]);

        $player = new Player();
        $player->name = $request->input('player-name');
        $player->position = $request->input('player-position');
        $player->birthday = $request->input('player-birthday');
        $team = Auth::guard('mister')->user()->team;
        $player->team()->associate($team);
        $player->save();
        return redirect()->route('mister.equipo');
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
