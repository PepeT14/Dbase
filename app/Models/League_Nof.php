<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class League_Nof extends Model
{

    protected $table = 'leagues_nof';

    //Club (Many to One)
    public function club(){
        return $this->belongsTo('App\Models\Club','club_id');
    }
    //Teams (Many to Many)
    public function teams(){
        return $this->belongsToMany('App\Models\Team','teams_leagues_nof','league_nof_id','team_id');
    }
}
