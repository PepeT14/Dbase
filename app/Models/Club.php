<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    //Defining Table

    protected $table='clubs';

    protected $dates = [
        'created_at',
        'updated_at',
        'trial_ends_at',
        'deleted_at'
    ];

    //Relationships

        //Admin (One to One)
    public function admin(){
        return $this->hasOne('App\Models\Admin','club_id');
    }

        //Team (One to Many)
    public function teams(){
        return $this->hasMany('App\Models\Team','club_id');
    }

        //Material (One to Many)
    public function materials(){
        return $this->hasMany('App\Models\ClubMaterial','club_id');
    }

}
