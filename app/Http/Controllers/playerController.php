<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class playerController extends Controller
{
    //

    public function home(){
        return view('player.home');
    }

    public function create(Request $request){

        $this->validate($request,[
            'player-name' =>'required|string',
            'player-position' =>'string',
            'player-birthday' =>'required|date',
        ]);

        $player = new Player();
        $player->name = $request->input('player-name').' '.$request->input('player-apellidos');
        $player->position = $request->input('player-position');
        $player->birthday = $request->input('player-birthday');
        if($request->has('player-number')){
            $player->number = $request->input('player-number');
        }
        $team = Auth::guard('mister')->user()->team;
        $player->team()->associate($team);
        $player->save();
        return redirect()->route('mister.equipo');
    }

}
