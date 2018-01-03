<?php

use Illuminate\Database\Seeder;

class RaceResultsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $heats=array(1,3,6,20);

        foreach ($heats as $heat) {
            DB::table('race_results')->insert([
                'customer_id' => 1,
                'race_heat_id' => $heat,
                'time' => date('H:i:s', mktime(rand(1, 2),rand(0,60), rand(0,60)))
            ]);
        }
    }
}
