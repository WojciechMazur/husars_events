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

    public function futureRaces(){
        return DB::table('races')
            ->join('race_heats', 'race_heats.race_id', '=', 'races.id')
            ->join('race_registrations', 'race_registrations.race_heat_id','=','race_heats.id')
            ->where([
                ['race_registrations.customer_id', '=', $this['id']],
                ['races.date', '>=', date('Y-m-d')]
            ])
            ->select('races.*',
                'race_registrations.id as race_registration_id',
                'race_registrations.status as status',
                'race_heats.heat_start',
                'race_heats.type',
                'race_heats.price',
                'race_heats.capacity',
                'race_heats.signed_in')
            ->whereDate('races.date', '>=', date('Y-m-d'))
            ->orderBy('races.date')
            ->get();
    }

    public function pastRaces()
    {
        $races = DB::table('races')
            ->join('race_heats', 'race_heats.race_id', '=', 'races.id')
            ->join('race_results', 'race_results.race_heat_id', '=', 'race_heats.id')
            ->where([
                ['race_results.customer_id', '=', $this['id']],
                ['races.date', '<', date('Y-m-d')]
            ])
            ->select(
                'races.*',
                'race_results.time',
                'race_results.status',
                'race_heats.id as race_heat_id',
                'race_heats.heat_start',
                'race_heats.type',
                'race_heats.price',
                'race_heats.capacity',
                'race_heats.signed_in')
            ->orderBy('races.date')
            ->get();
        foreach ($races as $race) {
            $results = Race::find($race->id)->competitors();
            foreach ($results as $result)
                if ($result->id == $this['id']) {
                    $race->position_total = $result->position;
                    break;
                }
            $race->signed_total=$results->count();
            $results = RaceHeat::find($race->race_heat_id)->competitors();
            foreach ($results as $result)
                if ($result->id == $this['id']) {
                    $race->position_heat = $result->position;
                    break;
                }
        }
        return $races;
    }


    public function trainings(){
        return DB::table('trainings')
            ->join('training_reservations', 'training_reservations.training_id','=','trainings.id')
            ->where([
                ['training_reservations.customer_id', '=', $this['id']],
                ['trainings.date', '>=', date('Y-m-d H:i:s')]
            ])
            ->select('trainings.*', 'training_reservations.id as reservation_id')
            ->orderBy('trainings.date')
            ->get();
    }

    public function trainingsPast(){
        return DB::table('trainings')
            ->join('training_reservations', 'training_reservations.training_id','=','trainings.id')
            ->where([
                ['training_reservations.customer_id', '=', $this['id']],
                ['trainings.date', '<', date('Y-m-d H:i:s')]
            ])
            ->select('trainings.*')
            ->orderBy('trainings.date')
            ->get();
    }


}
