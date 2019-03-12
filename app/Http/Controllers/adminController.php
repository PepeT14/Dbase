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
use App\Models\League_Nof;

class adminController extends Controller
{
    //INDEX
    public function index(Request $request){
        $admin = Auth::guard('admin')->user();
        return view('admin.home');
    }
    //HOME
    public function home(Request $request){
        $admin = Auth::guard('admin')->user();
        if($request->ajax()){
            $sections = view('admin.home')->renderSections();
            return response()->json(['html'=>$sections['content'],'title'=>'home']);
        }else{
            return view('admin.home');
        }
    }

    //Material
    public function material(Request $request){
        $admin = Auth::guard('admin')->user();
        $materialAgrupado = ClubMaterial::all()->where('club_id','=',$admin->club->id)->groupBy('type');
        $view = view('admin.material')->with(compact(['materialAgrupado']));
        $sections = $view->renderSections();
        if($request->ajax()){
            return response()->json(['html'=>$sections['content'],'title'=>'material']);
        }
        return $view;
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
    public function teams(Request $request){
        $admin = Auth::guard('admin')->user();
        $teams = $admin->club->teams;
        $leagues = League::all();
        $view = view('admin.teams')->with(compact(['admin','leagues','teams']));
        $sections = $view->renderSections();
        if($request->ajax()){
            return response()->json(['html'=>$sections['content'],'title'=>'equipos']);
        }
        return $view;
    }
    public function teamsDataUpdate(Request $request){
        $admin = Auth::guard('admin')->user();
        $team = $admin->club->teams->where('id',$request->team)->first();
        if($request->ajax()){
           return response()->json(['html'=>view('admin.includes.teamDetail',['team'=>$team])->render()]);
        };
        return $team;
    }
    //Ligas No Federativas
    public function leaguesNof(){
        $admin = Auth::guard('admin')->user();
        $club = $admin->club;
        $leaguesNof = League_Nof::all()->where('club_id','=',$club->id);
        return view('admin.leaguesNof')->with(compact('leaguesNof'));
    }

    //TECNICOS
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
    public function showMisters(Request $request){
        $admin = Auth::guard('admin')->user();
        if($request->ajax()){
            $sections = view('admin.misters',['admin' => $admin])->renderSections();
            return response()->json(['html'=>$sections['content'],'title'=>'tecnicos']);
        }
        return view('admin.misters',['admin' => $admin]);
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
