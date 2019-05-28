<?php
namespace Mccaulay\Bitcoin\Facades;

use Illuminate\Support\Facades\Facade;

class Bitcoin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bitcoin';
    }
}
