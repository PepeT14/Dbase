<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClubMaterial;
use Auth;
use App\Models\Team;
use App\Models\League;
use App\Models\Mister;
use Mail;
use App\Mail\inviteMister;
use DB;

class adminController extends Controller
{
    //Home
    public function home(){
        return view('admin.home');
    }

    //Material
    public function material(){
        $admin = Auth::guard('admin')->user();
        $material = ClubMaterial::where('club_id','=',$admin->id)->get();
        return view('admin.material')->with(compact(['material']));
    }

    public function createMaterial(Request $request){
        $admin = Auth::guard('admin')->user();
        $material = New ClubMaterial();
        $material->cantidad = $request->input('cantidad');
        $material->stock = $request->input('cantidad');
        $material->type= $request->input('type');
        $material->subtype = $request->input('subtype');
        $material->description = $request->input('description');
        $material->club_id = $admin->club->id;

        $material->save();
        return redirect()->action('adminController@material');
    }

    //Equipos
    public function teams(){
        $admin = Auth::guard('admin')->user();
        $teams = Team::where('club_id','=',$admin->club->id)->get();
        $leagues = League::all();
        $misters = collect([]);
        foreach($teams as $team){
            $m = Mister::all()->where('team_id','=',$team->id)->first();
            $misters->push($m);
        }
        return view('admin.teams')->with(compact(['teams','leagues','misters']));
    }

    //Invitar Entrenador
    public function misterInvite(Request $request){
        $admin = Auth::guard('admin')->user();
        $team = $request->input('team');
        Mail::to($request->input('email'))->send(new inviteMister($team));

        DB::table('valid_misters')->insert([
            'email' => $request->input('email'),
            'club' => $admin->club->name,
            'team' => $team

        ]);
        return redirect()->action('adminController@teams');
    }
}
