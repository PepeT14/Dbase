<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    protected $table = 'notes';

    //Relationship

        //misters (Many to One)
    public function mister(){
        return $this->belongsTo('App\Models\Mister','mister_id');
    }
}
