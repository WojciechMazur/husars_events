<?php

use Illuminate\Database\Seeder;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('races')->insert([
            'name' => 'Armageddon Challenge Kraków',
            'date' => new DateTime('28-08-2017'),
            'location' => 'Błonia Zabierzowskie, Zabierzów',
            'distance' => '5km',
            'description' =>'Centrum szkoleniowe Husaria Race Team zaprasza na Armageddon Challenge, 5 km morderczej trasy. Trasa przez bagna pola, okoliczne lasy i strome zbocza',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('races')->insert([
            'name' => 'Armageddon Challenge Kraków',
            'date' =>  new DateTime('29-08-2017'),
            'location' => 'Błonia Zabierzowskie, Zabierzów',
            'distance' => '12km',
            'description' =>'Centrum szkoleniowe Husaria Race Team zaprasza na Armageddon Challenge, 5 km morderczej trasy. Trasa przez bagna pola, okoliczne lasy i strome zbocza',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('races')->insert([
            'name' => 'Barbarian Race Ustroń',
            'date' =>  new DateTime('20-10-2017'),
            'location' => 'Ustroń, Czantoria Wielka',
            'distance' => '14km',
            'description' =>'Dołącz do najtrudniejszego technicznie biegu w Polsce. 30 przeszkód zakończonych podbiegiem pod Czantorię Wielką',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('races')->insert([
            'name' => 'Barbarian Race Arrow',
            'date' =>  new DateTime('28-08-2017'),
            'location' => 'Ustroń, Szkolna 2',
            'distance' => '400m',
            'description' =>'Minimum biegi, maksimum przeszkód. Sprawdź się na najtrudniejszych przeszkodach w szalonej rywalizacji',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('races')->insert([
            'name' =>  'Runmageddon Finał Ligi',
            'date' =>  new DateTime('18-11-2017'),
            'location' => 'Pabianice',
            'distance' => '12km',
            'description' =>'Finał Ligi - błoto, woda, hipotermia!!!',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('races')->insert([
            'name' => 'Barbarian Race Rebelia',
            'date' =>  new DateTime('18-04-2017'),
            'location' => 'Warszawa',
            'distance' => '10km',
            'description' =>'Barbarzyńcy podbijają stolicy. Więcej informacji wkrótce',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

    }
}
