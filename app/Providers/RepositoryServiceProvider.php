<?php

namespace App\Providers;

use App\Repositories\GithubRepoRepository;
use App\Repositories\GithubRepoRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(GithubRepoRepositoryInterface::class, GithubRepoRepository::class);
    }
}
