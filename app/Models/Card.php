<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //
    protected $table = 'cards';

    //Relationships

        //Player_stats (Many to One)
    public function playerMatch(){
        return $this->belongsTo('App\Models\PlayerMatch','player_match_id');
    }
}
