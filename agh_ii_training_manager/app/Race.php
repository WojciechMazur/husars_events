<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Race extends Model
{
    public function heats(){
        return DB::table('race_heats')
            ->select('race_heats.*')
            ->where('race_heats.race_id', '=', $this['id'])
            ->orderBy('race_heats.heat_start')
            ->get();
    }

    public function signed_in()
    {
        return DB::table('customers')
            ->join('race_registrations', 'race_registrations.customer_id', '=', 'customers.id')
            ->join('race_heats', 'race_heats.id', '=', 'race_registrations.race_heat_id')
            ->join('races', 'races.id', '=', 'race_heats.race_id')
            ->where('races.id', '=', $this['id'])
            ->select('customers.*',
                'race_heats.heat_start',
                'race_heats.type',
                'races.id as race_id',
                'race_registrations.status'
            )
            ->orderBy('customers.surname')
            ->get();
    }

    public function competitors(){
        return DB::table('customers')
            ->join('race_results', 'race_results.customer_id', '=', 'customers.id')
            ->join('race_heats', 'race_heats.id', '=', 'race_results.race_heat_id')
            ->join('races', 'races.id', '=', 'race_heats.race_id')
            ->where('races.id','=', $this['id'])
            ->select('customers.*',
                'race_heats.heat_start',
                'race_results.time',
                'race_results.status as race_status',
                'race_heats.type',
                'races.id as race_id',
                DB::raw('RANK() over (order by race_results.time asc) as position')

                )
            ->orderBy('customers.surname')
            ->get();
    }

}
