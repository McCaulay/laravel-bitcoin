<?php
namespace McCaulay\Bitcoin\Facades;

use Illuminate\Support\Facades\Facade;

class MiningApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'mining-api';
    }
}
