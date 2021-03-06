<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as adminUser;
use DB;

class Admin extends adminUser
{
    //
    use Notifiable;

    //Defining table
    protected $table = 'admin_clubs';
    //Mass assignable

    protected $fillable = ['name','email' , 'password', 'username' ];

    //Hidden for arrays

    protected $hidden = ['remember_token','password'];

    //Relationships

        //Club (One to One)
    public function club(){
        return $this->belongsTo('App\Models\Club','club_id');
    }

    public function events(){
        $events = DB::table('admin_events')->where('admin_id',$this->id)->get();
        return $events;
    }
}
