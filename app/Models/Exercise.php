<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    //
    protected $table = 'exercises';

    //Relationships

        //Mister (Many to One)
    public function mister(){
        return $this->belongsTo('App\Models\Mister','mister_id');
    }
        //Trainings (Many to Many)
    public function trainings(){
        return $this->belongsToMany('App\Models\Training','training_exercises','exercise_id','training_id');
    }
}
