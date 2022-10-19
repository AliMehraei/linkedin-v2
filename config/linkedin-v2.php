<?php

// config for alimehraei/LinkedInAllInOne
return [

    /*
    |--------------------------------------------------------------------------
    | Client ID
    |--------------------------------------------------------------------------
    |
    | LinkedIn's Client id for OAuth process
    |
    */
    'client_id' => env('LINKEDIN_CLIENT_ID', null),

    /*
    |--------------------------------------------------------------------------
    | Client Secret
    |--------------------------------------------------------------------------
    |
    | LinkedIn's Client secret for OAuth process
    |
    */
    'client_secret' => env('LINKEDIN_CLIENT_SECRET', null),

    /*
    |--------------------------------------------------------------------------
    | REDIRECT URI
    |--------------------------------------------------------------------------
    |
    | this is were we should handle the OAuth tokens after registering your
    | LinkedIn client
    |
    */
    'redirect_uri' => env('LINKEDIN_REDIRECT_URI', '/linkedin_oauth2callback'),
    'oauth_scope' => env('LINKEDIN_OAUTH_SCOPE', 'r_liteprofile,r_emailaddress'),

    'middleware' => ['web'],

    'domain' => null,

    'prefix' => '',

];
