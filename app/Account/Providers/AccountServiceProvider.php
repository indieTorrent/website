<?php

namespace App\Songs\Providers;

use App\Account\Contracts\AccountInterface;
use App\Account\Repositories\AccountRepository;
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
        $this->app->bind(AccountInterface::class, AccountRepository::class);
    }
}