<?php

use Illuminate\Database\Seeder;

class ProductImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_image')->insert([
            'image_id' => '1',
            'product_id' => '2'
        ]);

        DB::table('product_image')->insert([
            'image_id' => '2',
            'product_id' => '3'
        ]);

        DB::table('product_image')->insert([
            'image_id' => '3',
            'product_id' => '4'
        ]);

        DB::table('product_image')->insert([
            'image_id' => '1',
            'product_id' => '1'
        ]);
    }
}
