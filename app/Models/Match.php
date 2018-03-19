<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    //Defining table
    protected $table = 'matchs';

    //Relationships

        //League (Many to One)
    public function league(){
        return $this->belongsTo('App\models\League','league_id');
    }
        //Match_Team (One to Many)
    public function teams(){
        return $this->belongsToMany('App\Models\Team','team_match','match_id','team_id')->withPivot('positive_goals','quality');

    }
        //Player_Match_Stats (One to Many)
    public function players(){
        return $this->hasMany('App\Models\PlayerMatch','match_id');
    }

        //Sistems (Many to Many)
    public function sistems(){
        return $this->belongsToMany('App\Models\Sistem','sistem_match','match_id','sistem_id');
    }
}
