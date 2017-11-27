<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //Defining Table

    protected $table = 'teams';

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
        //Team_Match (One to Many)
    public function matchs(){
        return $this->hasMany('App\Models\TeamMatch','team_id');
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
        //Mister (One to One)
    public function mister(){
        return $this->hasOne('App\Models\Mister','team_id');
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
}
