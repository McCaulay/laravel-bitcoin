<?php
namespace McCaulay\Bitcoin\Providers;

use Illuminate\Support\ServiceProvider;

class BitcoinServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
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
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'bitcoin');

        // Register the classes to use with the facade
        $this->app->bind('bitcoin', 'McCaulay\Bitcoin\Bitcoin');
        $this->app->bind('blockchain-api', 'McCaulay\Bitcoin\Api\BlockchainApi');
        $this->app->bind('control-api', 'McCaulay\Bitcoin\Api\ControlApi');
        $this->app->bind('generate-api', 'McCaulay\Bitcoin\Api\GenerateApi');
        $this->app->bind('mining-api', 'McCaulay\Bitcoin\Api\MiningApi');
        $this->app->bind('network-api', 'McCaulay\Bitcoin\Api\NetworkApi');
        $this->app->bind('raw-transaction-api', 'McCaulay\Bitcoin\Api\RawTransactionApi');
        $this->app->bind('util-api', 'McCaulay\Bitcoin\Api\UtilApi');
        $this->app->bind('wallet-api', 'McCaulay\Bitcoin\Api\WalletApi');
    }
}
