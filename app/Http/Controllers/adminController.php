<?php

namespace App\Http\Controllers;

use App\Models\Instalacion;
use Illuminate\Http\Request;
use App\Models\ClubMaterial;
use Auth;
use App\Models\Team;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
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

    public function createEvent(Request $request){
        $admin = Auth::guard('admin')->user();
        if($request->ajax()) {
            $startEvent = Carbon::createFromFormat('d-m-Y H:i',$request->start);
            $endEvent = Carbon::createFromFormat('d-m-Y H:i',$request->end);
            $endDate = Carbon::createFromFormat('d-m-Y H:i','30-06-2019 00:00');
            $unidadFrecuencia = 'D';
            $c = 0;
            $fechas = array();
            if($request->has('repetition')){
                $repetition = collect($request->repetition);
                $dias = $repetition->get('dias');
                switch($repetition->get('frecuencia')){
                    case 'Semanal':
                        $unidadFrecuencia = 'W';
                        break;
                    case 'Mensual':
                        $unidadFrecuencia = 'M';
                        break;
                    case 'Anual':
                        $unidadFrecuencia = 'Y';
                }
                if($repetition->get('veces')==0){
                    $veces = 1;
                }else{
                    $veces = $repetition->get('veces');
                }
                $interval = "P".$veces.$unidadFrecuencia;
                $fechasInicio = $this->getDates($interval,$startEvent,$endDate,$dias);
                $fechasFinal = $this->getDates($interval,$endEvent,$endDate,$dias);
                if(count($fechasInicio) == count($fechasFinal)){
                    for($i=0;$i<count($fechasInicio);$i++){
                        DB::table('admin_events')->insert([
                            'start' => Carbon::createFromFormat('d-m-Y H:i',$fechasInicio[$i]),
                            'end' => Carbon::createFromFormat('d-m-Y H:i',$fechasFinal[$i]),
                            'title' => $request->title,
                            'admin_id' => $admin->id,
                            'category_id' => $request->category
                        ]);
                    }
                }
                return $admin->events();
            }else{
                $fechas[] = $startEvent->format('d-m-Y H:i');
                return $admin->events();
            }
        }
        return $admin;
    }
    private static function getDates($intervalo,$fechaInicio,$fechaFinal,$dias){
        $fechas = array();
        $period = CarbonPeriod::create($fechaInicio,$intervalo,$fechaFinal);
        foreach($period as $key => $date){
            for($i=0;$i<count($dias);$i++){
                $startEvent = new Carbon($date);
                $horaInicio = $startEvent->format('H');
                $minutos = $startEvent->format('i');
                $startEvent = $startEvent->startOfWeek()->addDay($dias[$i]-1)->addHours($horaInicio)->addMinutes($minutos)->format('d-m-Y H:i');
                $fechas[] = $startEvent;
            }
        }
        return $fechas;
    }
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

    public function updateCategory(Request $request){
        $admin = Auth::guard('admin')->user();
        DB::table('admin_event_categories')->where('id',$request->id)->update([
            'title' => $request->title,
            'color' => $request->color
        ]);
        return view('admin.includes.addCategoriePanel',['admin'=>$admin]);
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
