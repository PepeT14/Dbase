<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Match;

class MatchController extends Controller
{
    //Create
    public function createMatch(Request $request){

    }

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
