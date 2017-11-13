<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMatch extends Model
{
    //
    protected $table = 'team_match';

    //Relationships

        //Team (Many to One)
    public function team(){
        return $this->belongsTo('App\Models\Team','team_id');
    }
        //Match (Many to One)
    public function match(){
        return $this->belongsTo('App\Models\Match','match_id');
    }
}
