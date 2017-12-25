<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Mail\inviteAdmin;
use Mail;
use App\Models\Club;
use App\Models\League;
use DB;

class SuperAdmincontroller extends Controller
{
    //Home
    public function home(){

        $clubs = Club::all();

        $states = collect([]);
        $leagues = League::all();
        foreach($leagues as $league){
            if(!$states->contains($league->state)){
                $states->push($league->state);
            }
        }

        return view('superAdmin.home')->with(compact(['clubs','states','leagues']));
    }

    //invite admin
    public function invite(Request $request){
        $club = $request->input('club');
        Mail::to($request->input('email'))->send(new inviteAdmin($club));

        DB::table('valid_admins')->insert([
            'email' => $request->input('email'),
            'club' => $club,

        ]);
        return redirect()->action('superAdminController@home');
    }

}
