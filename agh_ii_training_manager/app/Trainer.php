<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = ['name', 'surname', 'specialization'];

    public function trainings(){
        return $this->belongsToMany('App/Training', 'trainings');
    }
}
