<?php

use Illuminate\Database\Seeder;

class ProductTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ref_product_types')->insert([
            'product_type_description' => "Training",
        ]);
        DB::table('ref_product_types')->insert([
            'product_type_description' => "Challenge",
        ]);
        DB::table('ref_product_types')->insert([
            'product_type_description' => "Race",
        ]);
    }
}
