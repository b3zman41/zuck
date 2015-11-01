<?php

namespace App\Providers;

use App\FacebookService;
use Illuminate\Support\ServiceProvider;

class FacebookServiceProvider extends ServiceProvider
{
   /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Facebook', function()
        {
            return new FacebookService();
        });
    }
}
