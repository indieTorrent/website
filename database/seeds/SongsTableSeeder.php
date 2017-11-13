<?php

use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('songs')->insert([
            'name' => 'The Open Road is Lonely',
            'alt_name' => 'But I Wouldn\'t Know',
            'album_id' => 1,
            'song_order' => 1,
            'sku_id' => 1,
            'preview_start' => 0,
            'is_active' => true,
            'is_in_back_catalog' => false,
        ]);
    }
}
