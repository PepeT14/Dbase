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
    /*---------------------------------------------
    * ----------------- INICIO  -------------------
    * ---------------------------------------------*/
    public function index(Request $request){
        $admin = Auth::guard('admin')->user();
        return view('admin.home',['admin'=>$admin]);
    }

    public function home(Request $request){
        $admin = Auth::guard('admin')->user();
        if($request->ajax()){
            $sections = view('admin.home',['admin'=>$admin])->renderSections();
            return response()->json(['html'=>$sections['content'],'title'=>'home']);
        }else{
            return view('admin.home',['admin'=>$admin]);
        }
    }

    /*-----------------------------------------------
    * ----------------- MATERIAL  -------------------
    * -----------------------------------------------*/
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


    /*----------------------------------------------
    * ----------------- EQUIPOS  -------------------
    * ----------------------------------------------*/
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

    /*-----------------------------------------------
    * ----------------- TÉCNICOS  -------------------
    * -----------------------------------------------*/
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

    /*----------------------------------------------------
    * ----------------- INSTALACIONES  -------------------
    * ----------------------------------------------------*/
    public function instalaciones(Request $request){
        $admin = Auth::guard('admin')->user();
        $instalaciones = $admin->club->instalaciones;
        $view = view('admin.instalaciones',compact(['instalaciones','admin']));
        if($request->ajax()){
            $sections = $view->renderSections();
            return response()->json(['html'=>$sections['content'],'title'=>'instalaciones']);
        }
        return $view;
    }

    /*----------------------------------------------------
    * ----------------- EVENTOS  -------------------
    * ----------------------------------------------------*/

    public function createCategory(Request $request){
        $admin = Auth::guard('admin')->user();
        if($request->ajax()){
            DB::table('admin_event_categories')->insert([
                'title' => $request->title,
                'color' => $request->color,
                'admin_id' => $admin->id
            ]);
            return view('admin.includes.addCategoriePanel',['admin'=>$admin]);
        }
        return $admin;
    }

    /*------------------------------------------------------------
     * ----------------- FUNCIONES AUXILIARES  -------------------
     * -----------------------------------------------------------*/
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
