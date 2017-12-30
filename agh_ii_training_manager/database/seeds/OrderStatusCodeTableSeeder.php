<?php

use Illuminate\Database\Seeder;

class OrderStatusCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_order_status_codes')->insert([
            'description' => 'Created'
        ]);
        DB::table('ref_order_status_codes')->insert([
            'description' => 'Unpaid'
        ]);
        DB::table('ref_order_status_codes')->insert([
            'description' => 'Paid'
        ]);
        DB::table('ref_order_status_codes')->insert([
            'description' => 'Shipped'
        ]);
        DB::table('ref_order_status_codes')->insert([
            'description' => 'Finalized'
        ]);


    }
}
