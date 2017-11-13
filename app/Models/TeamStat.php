<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamStat extends Model
{
    //Defining table
    protected $table = 'team_stats';

    //Relationships

        //Team (Many to One)
    public function team()
    {
        return $this->belongTo('App\Models\Team', 'team_id');
    }
        //Mister (Many to Many)
    public function misters(){
        return $this->belongsToMany('App\Models\Mister','mister_stats','team_stats_id','mister_id');
    }
}
