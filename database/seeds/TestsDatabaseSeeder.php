<?php

use App\Album;
use App\MusicEntity;
use App\Song;
use Illuminate\Database\Seeder;

class TestsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(GenresTableSeeder::class);

        /*
         * Lets build up some Artists with albums and songs!!
         */
        $artists = factory(MusicEntity::class, 10)->create();

        foreach ($artists as $artist) {
            $num = rand(1, 3);
            $albums = factory(Album::class, $num)->create([
                'entity_id' => $artist->id
            ]);

            foreach($albums as $album) {
                $num = rand(2, 5);
                factory(Song::class, $num)->create([
                    'album_id' => $album->id
                ]);
            }
        }
    }
}
