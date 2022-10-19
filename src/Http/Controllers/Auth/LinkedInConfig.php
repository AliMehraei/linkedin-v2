<?php

namespace alimehraei\LinkedInAllInOne\Http\Controllers\Auth;


use Carbon\Carbon;
use alimehraei\LinkedInAllInOne\LinkedInAllInOne;
use alimehraei\LinkedInAllInOne\ZohoToken;

class LinkedInConfig
{

    public static function getAuthUrl()
    {

        $client_id = config('linkedin-v2.client_id');
        $secret_key = config('linkedin-v2.client_secret');
        $z_url = config('linkedin-v2.accounts_url');
        $z_return_url = config('linkedin-v2.redirect_uri');
        $z_api_url = config('linkedin-v2.api_base_url');
        $z_current_user_email = config('linkedin-v2.current_user_email');
        $z_oauth_scope = config('linkedin-v2.oauth_scope');

        return "$z_url/oauth/v2/auth?scope=$z_oauth_scope&client_id=$client_id&response_type=code&access_type=offline&redirect_uri=$z_return_url";

    }

}
