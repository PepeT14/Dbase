<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubMaterial extends Model
{
    //
    protected $table='club_materials';

    protected $dates=['created_at,updated_at,deleted_at'];

    //Relationships
        //CLub (Many to One)
    public function club(){
        return $this->belongsTo('App\Models\Club','club_id');
    }
}
