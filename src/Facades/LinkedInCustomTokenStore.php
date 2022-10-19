<?php

namespace alimehraei\LinkedInAllInOne\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \alimehraei\LinkedInAllInOne\ZohoCustomTokenStore
 */
class LinkedInCustomTokenStore extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \alimehraei\LinkedInAllInOne\ZohoCustomTokenStore::class;
    }
}
