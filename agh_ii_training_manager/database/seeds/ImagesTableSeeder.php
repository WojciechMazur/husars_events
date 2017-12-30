<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('images')->insert([
            'url' => '/images/armageddon_challange_logo.jpg'
        ]);
        DB::table('images')->insert([
            'url' => '/images/HallowenChallenge.jpg'
        ]);
        DB::table('images')->insert([
            'url' => '/images/trening_na_przeszkodach.jpg'
        ]);
    }

}
