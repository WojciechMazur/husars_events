<?php

use Illuminate\Database\Seeder;

class RaceRegistrationSeeder extends Seeder
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
            $paid = rand(0, 1);
            DB::table('race_registrations')->insert([
                'customer_id' => 1,
                'race_heat_id' => $heat,
                'status' => ($paid == 0 ? 'unpaid' : 'paid')
            ]);
        }
    }
}
