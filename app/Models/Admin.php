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
    public function status(){
        $exists = DB::table('admin_clubs')->where('email',$this->email)->first();
        $valid = DB::table('valid_admins')->where('email',$this->email)->first();
        if(is_null($exists)){
            if(is_null($valid)){
                return "POR INVITAR";
            }
            else{
                return "Pendiente";
            }
        }
        else{
            return "registrado";
        }
    }
}
