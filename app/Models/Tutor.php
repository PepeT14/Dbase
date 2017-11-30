<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as tutorUser;

class Tutor extends tutorUser
{
    //Notifications
    use Notifiable;

    //Mass assignable

    protected $fillable = ['name','email' , 'password', 'username'];

    //Hidden for arrays

    protected $hidden = ['remember_token','password'];

    //Relationships

        //Player (One to One)

    public function player(){
        return $this->belongsTo('App\Models\Player','player_id');
    }

}
