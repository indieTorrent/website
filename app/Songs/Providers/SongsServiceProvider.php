<?php

namespace App\Songs\Providers;

use App\Songs\Api\v1\Contracts\SongsApiInterface;
use App\Songs\Api\v1\Repositories\SongsApiRepository;
use App\Songs\Contracts\FeaturedSongsInterface;
use App\Songs\Contracts\SongsInterface;
use App\Songs\Repositories\FeaturedSongsRepository;
use App\Songs\Repositories\SongsRepository;
use Illuminate\Support\ServiceProvider;

class SongsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SongsInterface::class, SongsRepository::class);
        $this->app->bind(SongsApiInterface::class, SongsApiRepository::class);
        $this->app->bind(FeaturedSongsInterface::class, FeaturedSongsRepository::class);
    }
}