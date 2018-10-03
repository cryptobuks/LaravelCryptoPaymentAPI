<?php

namespace Omnitask\CryptoPaymentAPI;

use Illuminate\Support\ServiceProvider;

class CryptoPaymentAPIServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'omnitask');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'omnitask');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
         $this->publishes([
            __DIR__.'/path/to/config/crypto_payment_api.php' => config_path('cryptopaymentapi.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/cryptopaymentapi.php', 'cryptopaymentapi');

        // Register the service the package provides.
        $this->app->singleton('cryptopaymentapi', function ($app) {
            return new CryptoPaymentAPI;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['cryptopaymentapi'];
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
            __DIR__.'/../config/cryptopaymentapi.php' => config_path('cryptopaymentapi.php'),
        ], 'cryptopaymentapi.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/omnitask'),
        ], 'cryptopaymentapi.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/omnitask'),
        ], 'cryptopaymentapi.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/omnitask'),
        ], 'cryptopaymentapi.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
