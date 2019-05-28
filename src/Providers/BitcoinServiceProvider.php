<?php
namespace Mccaulay\Bitcoin\Providers;

use Illuminate\Support\ServiceProvider;

class BitcoinServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('bitcoin.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'bitcoin');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-bitcoin', function () {
            return new Bitcoin;
        });
    }
}
