<?php
namespace Mccaulay\Bitcoin\Providers;

use Illuminate\Support\ServiceProvider;

class BlockApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('block-api', 'Mccaulay\Bitcoin\Api\BlockApi');
    }
}
