<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ImagesTableSeeder::class);
         $this->call(ProductTypesTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
         $this->call(ProductImageTableSeeder::class);
         $this->call(OrderStatusCodeTableSeeder::class);
         $this->call(CustomerTableSeeder::class);
         $this->call(TrainersSeeder::class);
         $this->call(TrainingsSeeder::class);
         $this->call(trainingReservationsSeeder::class);
    }
}
