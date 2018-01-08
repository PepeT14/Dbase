<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mister;
use App\Models\Team;
use App\Models\League;
use DB;
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
}
