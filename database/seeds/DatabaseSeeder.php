<?php

use App\Album;
use App\MusicEntity;
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
        $this->log("<info>Seeding:</info> 50 Artists");
        $entities = factory(MusicEntity::class, 50)->create();

        foreach ($entities as $entity) {
            $num = rand(1, 5);
            $this->log("<info>Seeding:</info> ".$num." Albums for Music Entity ID ".$entity->id);
            $albums = factory(Album::class, $num)->create([
                'entity_id' => $entity->id
            ]);

            foreach($albums as $album) {
                $num = rand(2, 10);
                $this->log("<info>Seeding:</info> ".$num." Songs for Album ID ".$album->id);
                factory(Song::class, $num)->create([
                    'album_id' => $album->id
                ]);
            }
        }
    }

    private function log($msg) {
        $this->command->getOutput()->writeln($msg);
    }
}
