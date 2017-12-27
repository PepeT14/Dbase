<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMaterial extends Model
{
    //
    protected $table='team_materials';

    protected $dates=['created_at,updated_at,deleted_at'];

    //Relationships

        //Team (One to Many)
    public function team(){
        return $this->belongsTo('App\Models\Team','team_id');
    }
}
