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
        return intval($minutos) + intval($minutosTitular);
    }
}
