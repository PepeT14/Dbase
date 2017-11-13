<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    //
    protected $table = 'match_goals';

    //Relationships
        //Player_stat (Many to One)
    public function playerMatch(){
        return $this->belongsTo('App\Model\PlayerMatch','player_match_id');
    }
}
