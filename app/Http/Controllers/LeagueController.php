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

      return redirect()->action('superAdminController@home');
    }

    //HOME
    public function home($league){
        return view('league.league',compact('league'));
    }
}
