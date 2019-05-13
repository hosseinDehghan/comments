<?php

namespace Hosein\Comments;

use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'CommentsView');
        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/CommentsView'),
        ],"commentsview");
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->publishes([
            __DIR__.'/Migrations' => database_path('/migrations')
        ], 'commentsmigrations');
    }
}
