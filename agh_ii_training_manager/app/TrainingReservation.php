<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingReservation extends Model
{
    public function customer(){
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    public function training(){
        return $this->belongsTo('App\Training', 'training_id');
    }
}
