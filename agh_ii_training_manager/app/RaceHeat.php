<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RaceHeat extends Model
{
    public $timestamps = false;

    public function competitors(){
        return DB::table('customers')
            ->join('race_results', 'race_results.customer_id', '=', 'customers.id')
            ->join('race_heats', 'race_heats.id', '=', 'race_results.race_heat_id')
            ->where('race_heats.id','=', $this['id'])
            ->select('customers.*',
                'race_heats.heat_start',
                'race_results.time',
                'race_results.status as race_status',
                'race_heats.type',
                DB::raw('RANK() over (order by race_results.time asc) as position'))
            ->orderBy('customers.surname')
            ->get();
    }
}
