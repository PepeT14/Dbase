<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    //
    protected $table='leagues';

    //Relationships

        //Team (One to Many)
    public function teams(){
        return $this->hasMany('App\Models\Team','league_id');
    }

        //Match (One to Many)
    public function matchs(){
        return $this->hasMany('App\Models\Match','league_id');
    }
}
