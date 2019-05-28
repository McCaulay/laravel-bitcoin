<?php
namespace Mccaulay\Bitcoin\Facades;

use Illuminate\Support\Facades\Facade;

class BlockApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'block-api';
    }
}
