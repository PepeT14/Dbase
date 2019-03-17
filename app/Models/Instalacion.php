<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model
{
    //

    protected $table = 'instalaciones';

    //Club
    public function club(){
        return $this->belongsTo('App\Models\Club','club_id');
    }

        //Reserva (one to Many)
    public function reservas(){
        return $this->hasMany('App\Models\Reserva','instalacion_id');
    }
}
