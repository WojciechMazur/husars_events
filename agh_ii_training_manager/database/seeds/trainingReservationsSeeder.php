<?php

use Illuminate\Database\Seeder;

class trainingReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('training_reservations')->insert([
            'customer_id' => 1,
            'training_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('training_reservations')->insert([
            'customer_id' => 1,
            'training_id' => 2,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('training_reservations')->insert([
            'customer_id' => 1,
            'training_id' => 3,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('training_reservations')->insert([
            'customer_id' => 2,
            'training_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('training_reservations')->insert([
            'customer_id' => 2,
            'training_id' => 2,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
