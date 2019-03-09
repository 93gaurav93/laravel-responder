<?php

namespace gaurav93d\LaravelResponder;

use Illuminate\Support\ServiceProvider;

class LaravelResponderServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'gaurav93d');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'gaurav93d');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelresponder.php', 'laravelresponder');

        // Register the service the package provides.
        $this->app->singleton('laravelresponder', function ($app) {
            return new LaravelResponder;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelresponder'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravelresponder.php' => config_path('laravelresponder.php'),
        ], 'laravelresponder.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/gaurav93d'),
        ], 'laravelresponder.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/gaurav93d'),
        ], 'laravelresponder.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/gaurav93d'),
        ], 'laravelresponder.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
