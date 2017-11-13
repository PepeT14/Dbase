<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as playerUser;

class Player extends playerUser
{
    //
    use Notifiable;

    //Mass assignable

    protected $fillable = ['name','email' , 'password', ];

    //Hidden for arrays

    protected $hidden = ['remember_token','password'];

    //Relationships

        //Match_stats (One to Many)

    public function matchStats(){
        return $this->hasMany('App\Model\Match_stat','player_id');
    }

        //Trainings (Many to Many)

    public function assitences(){
        return $this->belongsToMany('App\Models\Assistence','player_id');
    }

        //Player_stats (One to Many)

    public function playerStats(){
        return $this->hasMany('App\Models\Player_stat','player_id');
    }

        //Tutors (One to One)

    public function tutor(){
        return $this->hasOne('App\Models\Tutor','player_id');
    }

        //Teams (Many to One)

    public function team(){
        return $this->belongsTo('App\Models\Team','team_id');
    }

        //Lesion (One to Many)
    public function lesions(){
        return $this->hasMany('App\Models\Lesion','player_id');
    }

}
