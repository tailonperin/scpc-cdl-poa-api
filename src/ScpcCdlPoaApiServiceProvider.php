<?php

namespace Tailonperin\ScpcCdlPoaApi;

use Illuminate\Support\ServiceProvider;

class ScpcCdlPoaApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'scpc-cdl-poa-api');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'scpc-cdl-poa-api');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('scpc-cdl-poa-api.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/scpc-cdl-poa-api'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/scpc-cdl-poa-api'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/scpc-cdl-poa-api'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'scpc-cdl-poa-api');

        // Register the main class to use with the facade
        $this->app->singleton('scpc-cdl-poa-api', function () {
            return new ScpcCdlPoaApi;
        });
    }
}
