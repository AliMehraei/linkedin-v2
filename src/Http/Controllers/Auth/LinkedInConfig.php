<?php

namespace alimehraei\LinkedInAllInOne\Http\Controllers\Auth;


class LinkedInConfig
{

    public static function getAuthUrl()
    {

        $client_id = config('linkedin-v2.client_id');
        $return_url = config('linkedin-v2.redirect_uri');
        $oauth_scope = config('linkedin-v2.oauth_scope');

        return "https://www.linkedin.com/oauth/v2/authorization?scope=$oauth_scope&client_id=$client_id&response_type=code&redirect_uri=$return_url";

    }

}
