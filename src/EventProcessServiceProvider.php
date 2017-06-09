<?php

namespace Jacksunny\EventProcess;

use Illuminate\Support\ServiceProvider;
use Jacksunny\EventProcess\EventDispatcherContract;
use Jacksunny\EventProcess\DefaultEventDispatcher;
use Jacksunny\EventProcess\TreeWalkerContract;
use Jacksunny\EventProcess\DefaultTreeWalker;

class EventProcessServiceProvider extends ServiceProvider
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
         $this->app->singleton('Jacksunny\EventProcess\EventDispatcherContract', function ($app) {
            return new DefaultEventDispatcher();
        });
        $this->app->singleton('Jacksunny\EventProcess\TreeWalkerContract', function ($app) {
            return new DefaultTreeWalker();
        });
    }
}
