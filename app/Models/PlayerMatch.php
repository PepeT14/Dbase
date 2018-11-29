<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerMatch extends Model
{
    //Defining table
    protected $table ='player_match';
    public $timestamps=false;

    //Relationships

        //Player (Many to One)
    public function player(){
        return $this->belongsTo('App\Models\Player','player_id');
    }
        //Macth (Many to One)
    public function match(){
        return $this->belongsTo('App\Models\Match','match_id');
    }
        //Cards (One to Many)
    public function cards(){
        return $this->hasMany('App\Models\Card','player_match_id');
    }
        //goals (One to Many)
    public function goals(){
        return $this->hasMany('App\Models\Goal','player_match_id');
    }
}
