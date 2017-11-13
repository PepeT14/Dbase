<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as misterUser;

class Mister extends misterUser
{
    //
    use Notifiable;

    //Relationships

        //Team (One to One)
    public function team(){
        return $this->belongsTo('App\Models\Team','team_id');
    }
        //Team_Stats (Many to Many)
    public function stats(){
        return $this->belongsToMany('App\Models\TeamStat','mister_stats','mister_id','team_stats_id');
    }
        //Exercises (One to Many)
    public function exercises(){
        return $this->hasMany('App\Models\Exercise','mister_id');
    }

        //notes (One to Many)
    public function notes(){
        return $this->hasMany('App\Models\Note','mister_id');
    }
}
