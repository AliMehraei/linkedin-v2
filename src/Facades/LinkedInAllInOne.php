<?php

namespace alimehraei\LinkedInAllInOne\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \alimehraei\LinkedInAllInOne\LinkedInAllInOne
 */
class LinkedInAllInOne extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \alimehraei\LinkedInAllInOne\LinkedInAllInOne::class;
    }
}
