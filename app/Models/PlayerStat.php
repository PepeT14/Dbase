<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerStat extends Model
{
    //defining table

    protected $table='player_stats';

    //Relationships

        //Player (Many to One)
    public function player(){
        return $this->belongsTo('App\Models\Player','player_id');
    }
        //Team (Many to Many)
    public function teams(){
        return $this->belongsToMany('App\Models\Team');
    }
}
