<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubMaterial extends Model
{
    //
    protected $table='club_materials';

    //Relationships
        //CLub (Many to One)
    public function club(){
        return $this->belongsTo('App\Models\Club','club_id');
    }
}
