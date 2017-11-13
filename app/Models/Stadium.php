<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    //Defining table
    protected $table = 'stadiums';

    //Relationships

        //Team (One to One)
    public function team(){
        return $this->belongsTo('App\Models\Team','team_id');
    }
}
