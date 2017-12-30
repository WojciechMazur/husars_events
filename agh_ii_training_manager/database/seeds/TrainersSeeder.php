<?php

use Illuminate\Database\Seeder;

class TrainersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trainers')->insert([
            'name' => 'Przemysław',
            'surname'=> 'Senderski',
            'specialization' => 'Short and medium distances, obstacles',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('trainers')->insert([
            'name' => 'Wojciech',
            'surname'=> 'Brzoskwinia',
            'specialization' => 'Long and ultra distances, difficult terrain, obstacles',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('trainers')->insert([
            'name' => 'Artur',
            'surname'=> 'Surus',
            'specialization' => 'Functional training, party maker',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('trainers')->insert([
            'name' => 'Dariusz',
            'surname'=> 'Ilnicki',
            'specialization' => 'Diet, functional training, obstacles',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
