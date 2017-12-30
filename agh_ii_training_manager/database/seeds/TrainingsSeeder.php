<?php

use Illuminate\Database\Seeder;

class TrainingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trainings')->insert([
            'capacity_limit' => 25,
            'signed_in' => 5,
            'date' => new DateTime('2018-01-21 12:30'),
            'duration_minutes' => 90,
            'location' => 'Błonia Zabierzowskie, Zabierzów',
            'description' => 'Dariusz Ilnicki poprowadzi warsztaty z poprawnego odżywiania dla biegaczy górskich',
            'trainer_id' => 4,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('trainings')->insert([
            'capacity_limit' => 50,
            'signed_in' => 1,
            'date' => new DateTime('2018-01-28 10:00'),
            'duration_minutes' => 120,
            'description' => 'Warsztaty biegowe pod okiem ultrasa - Wojciecha Brzoskwini',
            'location' => 'Al. Waszyngtona 2, Kraków',
            'trainer_id' => 2,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('trainings')->insert([
            'capacity_limit' => 20,
            'signed_in' => 12,
            'date' => new DateTime('2018-01-02 21:00'),
            'duration_minutes' => 60,
            'description' => 'Trening w FitPark Kraków pod okiem Artur Surus. Wejście 10 zł lub karta multisport',
            'location' => 'FitPark Park Wodny, ul. Dobrego Pasterza 126, Kraków',
            'trainer_id' => 3,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);


    }
}
