<?php

namespace gaurav93d\LaravelResponder\Facades;

use Illuminate\Support\Facades\Facade;

class Responder extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelresponder';
    }
}
