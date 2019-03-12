<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Team extends Model
{
    //Defining Table

    protected $table = 'teams';
    public $timestamps=false;

    //Relationships

        //League (Many to One)
    public function league(){
        return $this->belongsTo('App\models\League','league_id');
    }
        //Stadium (One to One)
    public function stadium(){
        return $this->hasOne('App\Model\Stadium','team_id');
    }
        //Club (Many to One)
    public function club(){
        return $this->belongsTo('App\Models\Club','club_id');
    }
        //Team_Match (Many to Many)
    public function matchs(){
        return $this->belongsToMany('App\Models\Match','team_match','team_id','match_id')->withPivot('positive_goals','quality');
    }
        //Player_Stats (Many to Many)
    public function playerStats(){
        return $this->belongsToMany('App\Models\PlayerStat','teams_player');
    }
        //Player (One to Many)
    public function players(){
        return $this->hasMany('App\Models\Player','team_id');
    }
        //Training (One to Many)
    public function trainings(){
        return $this->hasMany('App\Models\Training','team_id');
    }
        //Mister (One to Many)
    public function misters(){
        return $this->hasMany('App\Models\Mister','team_id');
    }
        //Team_Stats (One to Many)
    public function teamStats(){
        return $this->hasMany('App\Models\TeamStat','team_id');
    }

        //Sistems (One to Many)
    public function sistems(){
        return $this->hasMany('App\models\Sistem','team_id');
    }

        //Materials (One to Many)
    public function materials(){
        return $this->hasMany('App\Models\TeamMaterial','team_id');
    }

    //Ligas no federativas (Many to Many)
    public function leagues_nof(){
        return $this->belongsToMany('App\Models\League_nof','teams_leagues_nof','team_id','league_nof_id');
    }

    public function misterStatus(){
        if($this->mister){
            return "Registrado";
        }
        else{
            $valid = DB::table('valid_misters')->where('team',$this->name)->first();
            if(is_null($valid)){
                return "Por invitar";
            }else{
                return "Pendiente";
            }
        }
    }
}
