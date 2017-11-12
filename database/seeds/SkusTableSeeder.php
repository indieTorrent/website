<?php

use Illuminate\Database\Seeder;

class SkusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skus')->insert([
            'price' => 1.00,
            'is_digital' => true,
            'is_taxable' => false,
            'requires_shipping' => false,
            'is_active' => true,
        ]);
    }
}
