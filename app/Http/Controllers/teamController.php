<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Auth;
use App\Models\League;

class teamController extends Controller
{
    //Create
    public function create(Request $request){

        $this->validate($request,[
            'team-name' =>'required',
            'team-category' => 'required'
        ]);
        $team = New Team();
        $admin = Auth::guard('admin')->user();
        $name = $request->input('team-name');
        $category = $request->input('team-category');

        if(!$admin->club->teams()->where('category','=',$category)->where('name','=',$name)->get()->isEmpty()){
            $errors = 'Ya existe un equipo con este nombre y en esta categoria para este club.';
            return response()->json(['error'=>$errors]);
        }else{
            $team->name = $name;
            $team->club_id = $admin->club->id;
            $team->category = $category;
            if($request->has('team-league')){
                $league = $request->input('team-league');
                $league = League::all()->where('name','=',$league)->first();
                $team->league_id = $league->id;
            }
            $team->save();
            $teams = $admin->club->teams()->whereNotNull('league_id')->get();
            $teamsNof = $admin->club->teams()->whereNull('league_id')->get();
            return response()->json(['teams'=>$teams,'teamsNof'=>$teamsNof]);
        }


    }

    //HOME
    public function home($team){
        $team= Team::all()->where('id','=',$team);
        return view('team.team',compact('team'));
    }

    //Show
    public function show(){
        $mister = Auth::guard('mister')->user();
        $order = ['Portero','Defensa','MedioCentro','Delantero'];
        $players = $mister->team->players->sortBy(function($player) use($order){
            return array_search($player->position,$order);
        });
        return view('mister.equipo',with(compact('mister','players')));
    }


}
