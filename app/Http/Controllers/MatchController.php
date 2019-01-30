<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Match;

class MatchController extends Controller
{
    //Create
    public function create(Request $request){
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


    //Empezar partido
    public function show($match){
        $mister = Auth::guard('mister')->user();
        $match = Match::find($match);
        return view('mister.partido',compact(['match','mister']));
    }

    //Cambiar jugador durante partido
    public function changePlayer(Request $request,$id){
        $match = Match::find($id);
        $titularId = $request->input('titular');
        $suplenteId = $request->input('suplente');
        $minutos = $request->input('minuto') - $request->input('minutosTitular');
        $minutosTitular = $match->players->where('id',$titularId)->first()->pivot->minutes;
        $match->players()->updateExistingPivot($titularId, ['minutes'=>intval($minutos) + $minutosTitular,'playing'=>0]);
        $match->players()->updateExistingPivot($suplenteId, ['playing'=>1]);
        return $minutosTitular + intval($minutos);
    }

    //Actualizar los minutos durante el partido
    public function updateMinutes(Request $request,$id){
        $match = Match::find($id);
        $array = collect($request->all());
        $res = collect([]);
        foreach($array as $arr){
            $jugadorId = $arr['jugador'];
            $res->push($jugadorId);
            $minutos = $arr['minuto'] - $arr['minutoJugador'];
            $minutosJugador =$minutos + $match->players->where('id',$jugadorId)->first()->pivot->minutes;
            $match->players()->updateExistingPivot($jugadorId, ['minutes'=>$minutosJugador]);
        }
        $match = Match::Where('id',$id)->first();
        return  view('mister.partido-jugadores',compact('match'));
    }
}
