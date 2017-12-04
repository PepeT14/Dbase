<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Mail\inviteAdmin;
use Mail;
use App\Models\Club;
use App\Models\League;

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
        return 'E-mail enviado correctamente'.env('APP_URL');
    }

}
