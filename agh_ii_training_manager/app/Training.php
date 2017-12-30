<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = ['capacity_limit', 'signed_in', 'date', 'trainer_id', 'description', 'location', 'duration_minutes'];

    public function trainer(){
        return $this->hasOne('App\Trainer', 'trainer_id');
    }

    public function signedIn(){
        return $this->belongsToMany('App/Customers');
    }
}
