<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Map entity repository interface as key and implementation as value.
     *
     * @var array<string, string>
     */
    protected $repositories = [
        \App\Repositories\UserRepository::class => \App\Repositories\UserRepositoryEloquent::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositories();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Binds the repository interface to the repository implementation.
     *
     * @return void
     */
    private function registerRepositories(): void
    {
        foreach ($this->repositories as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
