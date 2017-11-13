<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    //
    protected $table =  'trainings';

    //Relationships

        //Assitences (One to Many)
    public function assitences(){
        return $this->hasMany('App\Models\Assistence','training_id');
    }
        //Exercises (Many to Many)
    public function exercises(){
        return $this->belongsToMany('App\Models\Exercise','training_exercises','training_id','exercise_id');
    }
        //Team (Many to One)
    public function team(){
        return $this->belongsTo('App\Models\Team','team_id');
    }
}
