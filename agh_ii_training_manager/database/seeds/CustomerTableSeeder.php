<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admins
        DB::table('admins')->insert([
            'username'=> 'admin1',
            'password'=> bcrypt('com.1234'),
            'email' => 'admin1@husars.com',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        //Customers

        DB::table('customers')->insert([
            'first_name' => 'Wojciech',
            'surname' => 'Mazur',
            'address' => 'Eugeniów, 55',
            'city' => 'Sienno',
            'state' => 'Mazowieckie',
            'country' => 'Poland',
            'email' => 'wojciech.mazur95@gmail.com',
            'phone' => '535022526',
            'zip-code'=>'27-350',
            'password' => bcrypt('com.1234'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        DB::table('customers')->insert([
            'first_name' => 'Adam',
            'surname' => 'Nowak',
            'address' => 'ul. Powstańców 36',
            'city' => 'Cracow',
            'state' => 'Małopolskie',
            'country' => 'Poland',
            'email' => 'adam.nowak@husars.com',
            'phone' => '57570330',
            'zip-code'=>'32-712',
            'password' => bcrypt('com.1234'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
