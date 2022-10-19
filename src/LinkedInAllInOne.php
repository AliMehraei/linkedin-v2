<?php

namespace alimehraei\LinkedInAllInOne;


use alimehraei\LinkedInAllInOne\Http\Controllers\Records\LinkedInConnectionController;

class LinkedInAllInOne
{

    // start - connections functions

    public static function getModuleCount($moduleName, $type = null, $value = null)
    {
        return LinkedInConnectionController::getAll($moduleName, $type, $value);
    }

    // end - connections functions


}
