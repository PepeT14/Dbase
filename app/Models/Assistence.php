<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assistence extends Model
{
    //
    protected $table = 'asistences';

    //Relationship

        //Player (Many to One)
    public function player(){
        return $this->belongsTo('App\Models\player');
    }

        //Training (Many to One)
    public function training(){
        return $this->belongsTo('App\Models\Training','training_id');
    }
}
