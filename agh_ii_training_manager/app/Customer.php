<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Support\Facades\DB;

class Customer extends Authenticable
{
    use Notifiable;

    protected $connection = 'mysql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'second_name', 'surname', 'address','city', 'state', 'country', 'phone', 'zip-code', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function trainingReservations(){
        return $this->hasMany('App\TrainingReservation');
    }

    public function trainings(){
        return DB::table('trainings')
            ->join('training_reservations', 'training_reservations.training_id','=','trainings.id')
            ->where('training_reservations.customer_id','=', $this['id'])
            ->whereDate('trainings.date','>=', date('Y-m-d H:i:s'))
            ->select('trainings.*', 'training_reservations.id as reservation_id')
            ->orderBy('trainings.date')
            ->get();
    }

    public function trainingsPast(){
        return DB::table('trainings')
            ->join('training_reservations', 'training_reservations.training_id','=','trainings.id')
            ->where('training_reservations.customer_id','=', $this['id'])
            ->whereDate('trainings.date','<', date('Y-m-d H:i:s'))
            ->select('trainings.*')
            ->orderBy('trainings.date')
            ->get();
    }


}
