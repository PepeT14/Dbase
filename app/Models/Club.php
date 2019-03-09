<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Club extends Model
{
    //Defining Table

    protected $table='clubs';

    protected $dates = [
        'created_at',
        'updated_at',
        'trial_ends_at',
        'deleted_at'
    ];

    //Relationships

        //Admin (One to One)
    public function admin(){
        return $this->hasOne('App\Models\Admin','club_id');
    }

        //Team (One to Many)
    public function teams(){
        return $this->hasMany('App\Models\Team','club_id');
    }

        //Material (One to Many)
    public function materials(){
        return $this->hasMany('App\Models\ClubMaterial','club_id');
    }


        //Instalaciones (One to Many)
    public function instalaciones(){
        return $this->hasMany('App\Models\Instalacion','club_id');
    }

        //Leagues no federativas (One to Many)
    public function leaguesNof(){
        return $this->hasMany('App\Models\League_Nof','club_id');
    }

        //Cuerpo Tecnico (One to Many)
    public function misters(){
        return $this->hasMany('App\Models\Mister','club_id');
    }

    public function adminStatus(){
        if($this->Admin){
            return "Registrado";
        }
        else{
            $valid = DB::table('valid_admins')->where('club',$this->name)->first();
            if(is_null($valid)){
                return "Por invitar";
            }else{
                return "Pendiente";
            }
        }
    }
    public function matchs(){
        $matchs = collect([]);
        $equipos = $this->teams();
        foreach($equipos as $equipo){
            $partidos = $equipo->matchs;
            $matchs->push($partidos);
        }
        return $matchs;
    }

}
