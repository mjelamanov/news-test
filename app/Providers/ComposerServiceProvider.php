<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * A map of a composer class as key and an array of string as views.
     *
     * @var array<string, string[]>
     */
    private $composers = [
        \App\View\Composers\ShareUserComposer::class => ['layouts.app'],
    ];

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
        $this->registerComposers();
    }

    /**
     * Binds the composers and the views.
     *
     * @return void
     */
    private function registerComposers(): void
    {
        foreach ($this->composers as $composer => $views) {
            $this->app['view']->composer($views, $composer);
        }
    }
}
