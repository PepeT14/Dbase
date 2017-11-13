<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sistem extends Model
{
    //defining table
    protected $table='sistems';

    //Relationships

        //Team (Many to One)
    public function team(){
        return $this->belongsTo('App\Models\Team','team_id');
    }

        //Match (Many to Many)
    public function matchs(){
        return $this->belongsToMany('App\Models\Match','sistem_match','sistem_id','match_id');
    }
}
