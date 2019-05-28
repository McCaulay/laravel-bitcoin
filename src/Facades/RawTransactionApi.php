<?php
namespace McCaulay\Bitcoin\Facades;

use Illuminate\Support\Facades\Facade;

class RawTransactionApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'raw-transaction-api';
    }
}
