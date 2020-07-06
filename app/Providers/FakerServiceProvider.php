<?php

namespace App\Providers;

use Faker\Generator;
use Illuminate\Support\ServiceProvider;
use Mmo\Faker\PicsumProvider;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->addPicsumProviderToFaker();
        }
    }

    /**
     * Adds a picsum image provider to the faker instance.
     *
     * @return void
     */
    private function addPicsumProviderToFaker(): void
    {
        $this->app->resolving(Generator::class, function (Generator $generator) {
            $generator->addProvider(new PicsumProvider($generator));
        });
    }
}
