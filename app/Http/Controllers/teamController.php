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

        $league = League::where('name','=',$leagueName)->first();
        $team->league_id = $league->id;

        $team->save();

        return redirect()->action('adminController@teams');

    }
}
