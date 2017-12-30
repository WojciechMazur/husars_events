<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Armageddon Challenge 5km',
            'price' => 119.99,
            'description' =>'Centrum szkoleniowe Husaria Race Team zaprasza na Armageddon Challenge, 5 km morderczej trasy',
            'type_code' => 3
        ]);

        DB::table('products')->insert([
            'name' => 'Armageddon Challenge 10km',
            'price' => 149.99,
            'description' =>'Armageddon Challenge, edycja Małopolska',
            'type_code' => 3
        ]);

        DB::table('products')->insert([
            'name' => 'Hallowen Challenge',
            'price' => 39.99,
            'description' =>'Come and try yourself with Hussars Hallowen Spooky Challange',
            'type_code' => 2
        ]);

        DB::table('products')->insert([
            'name' => 'Trening na przeszkodach',
            'price' => 19.99,
            'description' =>'Centrum szkoleniowe Husaria Race Team zaprasza trening na przeszkodach',
            'type_code' => 1
        ]);
    }
}
