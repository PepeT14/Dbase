<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\League;
use App\Models\Club;

class LeagueController extends Controller
{
    //

    public function create(Request $request){
      $league = new League();
      $league->name = $request->input('name');
      $league->state = $request->input('state');
      $league->province = $request->input('province');
      $league->category = $request->input('category');

      $league->save();

        $clubs = Club::all();

        $states = collect([]);
        $leagues = League::all();
        foreach($leagues as $league){
            if(!$states->contains($league->state)){
                $states->push($league->state);
            }
        }

      return redirect()->back()->with(compact(['clubs','states','leagues']));
    }
}
