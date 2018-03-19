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
        $team = New Team();
        $admin = Auth::guard('admin')->user();
        $team->name = $request->input('name');
        $team->club_id = $admin->club->id;
        $leagueName = $request->input('league');
        $team->category = $request->input('category');
        $league = League::all()->where('name','=',$leagueName)->first();
        $team->league_id = $league->id;

        $team->save();

        return redirect()->action('adminController@teams');

    }

    //HOME
    public function home($team){
        $team= Team::all()->where('id','=',$team);
        return view('team.team',compact('team'));
    }
}
