<?php

use Illuminate\Database\Seeder;

class RaceHeatSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('08:00:00'),
            'type' => 'elite',
            'price' => 100.00,
            'capacity' => 100,
            'race_id'=> 1,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('08:30:00'),
            'price' => 100.00,
            'capacity' => 200,
            'race_id'=> 1,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('08:00:00'),
            'type' => 'elite',
            'price' => 100.00,
            'capacity' => 100,
            'race_id'=> 2,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('08:30:00'),
            'price' => 100.00,
            'capacity' => 200,
            'race_id'=> 2,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('09:00:00'),
            'type' => 'elite',
            'price' => 160.00,
            'capacity' => 100,
            'race_id'=> 3,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('09:15:00'),
            'type' => 'competitive',
            'price' => 140.00,
            'capacity' => 100,
            'race_id'=> 3,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('09:30:00'),
            'price' => 120.00,
            'capacity' => 150,
            'race_id'=> 3,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('10:00:00'),
            'price' => 120.00,
            'capacity' => 150,
            'race_id'=> 3,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('16:00:00'),
            'price' => 40.00,
            'capacity' => 2,
            'race_id'=> 4,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('16:10:00'),
            'price' => 40.00,
            'capacity' => 2,
            'race_id'=> 4,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('16:20:00'),
            'price' => 40.00,
            'capacity' => 2,
            'race_id'=> 4,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('16:30:00'),
            'price' => 40.00,
            'capacity' => 2,
            'race_id'=> 4,
        ]);


        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('16:40:00'),
            'price' => 40.00,
            'capacity' => 2,
            'race_id'=> 4,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('16:50:00'),
            'price' => 40.00,
            'capacity' => 2,
            'race_id'=> 4,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('09:00:00'),
            'type' => 'elite',
            'price' => 280.00,
            'capacity' => 100,
            'race_id'=> 5,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('09:20:00'),
            'price' => 240.00,
            'capacity' => 200,
            'race_id'=> 5,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('09:40:00'),
            'price' => 240.00,
            'capacity' => 200,
            'race_id'=> 5,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('10:00:00'),
            'price' => 240.00,
            'capacity' => 200,
            'race_id'=> 5,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('10:20:00'),
            'price' => 240.00,
            'capacity' => 200,
            'race_id'=> 5,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('08:00:00'),
            'type' => 'elite',
            'price' => 180.00,
            'capacity' => 100,
            'race_id'=> 6,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('08:20:00'),
            'price' => 140.00,
            'capacity' => 200,
            'race_id'=> 6,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('08:40:00'),
            'price' => 140.00,
            'capacity' => 200,
            'race_id'=> 6,
        ]);

        DB::table('race_heats')->insert([
            'heat_start' =>new DateTime('09:00:00'),
            'price' => 140.00,
            'capacity' => 200,
            'race_id'=> 6,
        ]);







    }
}
