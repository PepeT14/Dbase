<?php

namespace App\Http\Controllers;

use App\Models\Instalacion;
use Illuminate\Http\Request;
use App\Models\ClubMaterial;
use Auth;
use App\Models\Team;
use App\Models\League;
use Mail;
use App\Mail\inviteMister;
use DB;
use MaddHatter\LaravelFullcalendar\Calendar;
use App\Models\League_Nof;

class adminController extends Controller
{
    //Home
    public function home(){
        $eventos = $this->getEvents();
        $partidos = $this->getMatchs();

        return view('admin.home');
    }

    //Material
    public function material(){
        $admin = Auth::guard('admin')->user();
        $materialAgrupado = ClubMaterial::all()->where('club_id','=',$admin->club->id)->groupBy('type');

        return view('admin.material')->with(compact(['materialAgrupado']));
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
    public function deleteMaterial($id){
        ClubMaterial::where('id',$id)->first()->delete();
        return $this->material();
    }
    public function addMaterial($id){
        $material=ClubMaterial::where('id',$id)->first();
        $material->cantidad = $material->cantidad+1;
        $material->stock = $material->stock+1;
        $material->save();
        return $this->material();
    }

    //Equipos
    public function teams(){
        $admin = Auth::guard('admin')->user();
        $teams = Team::where('club_id','=',$admin->club->id)->get();
        $leagues = League::all();
        return view('admin.teams')->with(compact(['teams','leagues']));
    }

    //Ligas No Federativas
    public function leaguesNof(){
        $admin = Auth::guard('admin')->user();
        $club = $admin->club;
        $leaguesNof = League_Nof::all()->where('club_id','=',$club->id);
        return view('admin.leaguesNof')->with(compact('leaguesNof'));
    }

    //Invitar Entrenador
    public function misterInvite(Request $request,$team){
        $admin = Auth::guard('admin')->user();
        Mail::to($request->input('email'))->send(new inviteMister($team));

        DB::table('valid_misters')->insert([
            'email' => $request->input('email'),
            'club' => $admin->club->name,
            'team' => $team

        ]);
        return redirect()->action('adminController@teams');
    }

    //Instalaciones
    public function instalaciones(){
        $admin = Auth::guard('admin')->user();
        $instalaciones = Instalacion::all()->where('club_id','=',$admin->club->id);
        return view('admin.instalaciones',compact('instalaciones'));
    }

    //CREAR EVENTOS
    public function getEvents(){
        $admin = Auth::guard('admin')->user();
        $events=collect([]);
        $adminEvents = $admin->events();

        foreach($adminEvents as $adminEvent){
            $event = Calendar::event(
                $adminEvent->title,//Titulo
                false,//¿Dia Entero?
                $adminEvent->start,//INICIO
                $adminEvent->end,//FIN
                $adminEvent->id.'e',//EVENT ID
                [
                    'editable' => true,
                ]
            );
            $events->push($event);
        }
        return $events;
    }
    private function getMatchs(){
        $admin = Auth::guard('admin')->user();
        $matchs= collect([]);
        $partidos = $admin->club->matchs();
        foreach($partidos as $partido){
            $match = Calendar::event(
                $partido->title,//Titulo
                false,//¿Dia Entero?
                $partido->start,//INICIO
                $partido->end,//FIN
                $partido->id,//EVENT ID
                [
                    'editable' => true,
                ]
            );
            $matchs->push($match);
        }
        return $matchs;
    }

}
