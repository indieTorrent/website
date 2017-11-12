<?php

use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('artists')->insert([
            'moniker' => 'Joey\'s Basement Band',
            'alt_moniker' => 'Still Living Down There',
            'city' => 'Portland',
            'territory' => 'Maine',
            'country_code' => 'US',
            'official_url' => 'indietorrent.org',
            'profile_url' => 'joeysbasementband',
            'is_active' => true,
            'approved_at' => '2017-11-12 00:00:00',
            'approver_id' => 1,
            'owner_id' => 1,
        ]);
    }
}
