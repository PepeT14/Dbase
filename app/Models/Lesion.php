<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesion extends Model
{
    //defining table
    protected $table='lesions';

    //Relationships

        //Player (Many to One)
    public function player(){
        return $this->belongsTo('App\Models\Player','player_id');
    }
}
