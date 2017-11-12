<?php

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
        $this->call(SkusTableSeeder::class);
        $this->call(ArtistsTableSeeder::class);
        $this->call(AlbumsTableSeeder::class);
        $this->call(SongsTableSeeder::class);
    }
}
