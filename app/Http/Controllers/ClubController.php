<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\League;

class ClubController extends Controller
{
    //
    public function create(Request $request){
        $club = New Club();

        $club->name = $request->input('name');
        $club->telephone = $request->input('telephone');
        $club->country=$request->input('country');
        $club->city=$request->input('city');
        $club->address = $request->input('address');
        $club->state = $request->input('state');

        //Controles de Imagen:
        if ($request->hasFile('escudo')) {
            if ($request->file('escudo')->isValid()) {
//          $file = $request->file('photo');
                $path = Storage::putFile('public/locales/'.$club->id, $request->file('escudo'));
                $path = str_replace('public', 'storage', $path);
                $club->escudo = $path;
            }
        }else{
            $club->escudo="";
        }

        $club->save();

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
