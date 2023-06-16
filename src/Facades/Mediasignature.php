<?php

namespace Heddiyoussouf\Mediasignature\Facades;

use Illuminate\Support\Facades\Facade;

class Mediasignature extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Mediasignature';
    }
}
