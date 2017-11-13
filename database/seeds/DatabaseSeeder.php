<?php

use App\Album;
use App\Artist;
use App\Song;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
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
        $this->log("<info>Seeding:</info> 100 Artists");
        $artists = factory(Artist::class, 100)->create();

        foreach ($artists as $artist) {
            $this->log("<info>Seeding:</info> Albums for Artist ID ".$artist->id);
            $albums = factory(Album::class, rand(1, 10))->create([
                'artist_id' => $artist->id
            ]);

            foreach($albums as $album) {
                $this->log("<info>Seeding:</info> Songs for Album ID ".$album->id);
                factory(Song::class, rand(5, 20))->create([
                    'album_id' => $album->id
                ]);
            }
        }
    }

    private function log($msg) {
        $this->command->getOutput()->writeln($msg);
    }
}
