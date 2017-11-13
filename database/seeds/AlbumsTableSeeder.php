<?php

use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('albums')->insert([
            'artist_id' => 1,
            'title' => 'My First Single',
            'alt_title' => 'Rerelease',
            'type' => 'f',
            'year' => 2017,
            'genre_id' => 1,
            'description' => 'The best record ever laid to tape!',
            'has_explicit_lyrics' => true,
            'is_active' => true,
        ]);
    }
}
