<?php

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model{

    protected $table = 'reservas';
    public $timestamps=false;

        //Team (Many to one)
    public function team(){
        $this->belongsTo('App\Models\Team','team_id');
    }

        //Instalacion (Many to One)
    public function instalacion(){
        $this->belongsTo('App\Models\Instalacion','instalacion_id');
    }
}