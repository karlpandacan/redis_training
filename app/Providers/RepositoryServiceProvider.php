<?php

namespace App\Providers;

use App\Models\Blog;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\BlogInterface', function () {
            return new \App\Repositories\Eloquents\BlogRepository(Blog::class);
        });
    }
}
