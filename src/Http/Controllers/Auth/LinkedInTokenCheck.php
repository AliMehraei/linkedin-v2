<?php

namespace alimehraei\LinkedInAllInOne\Http\Controllers\Auth;


use Carbon\Carbon;
use Illuminate\Http\Request;
use alimehraei\LinkedInAllInOne\Models\LinkedInToken;

class LinkedInTokenCheck
{

    public static function getToken()
    {
        $linkedin_token = LinkedInToken::query()->latest()->first();
        if ($linkedin_token) {
            $expiry_time = Carbon::parse($linkedin_token->expiry_time);
            if ($expiry_time->lt(Carbon::now())) {
                $zoho = new LinkedInCustomTokenStore();
                $linkedin_token = $zoho->refreshToken($linkedin_token->id);
            }
            return $linkedin_token;
        }
        return null;

    }

    public function applicationRegister()
    {
        return redirect(LinkedInConfig::getAuthUrl());
    }

    public static function saveTokens(Request $request)
    {
        $data = $request->all();

        if (!array_key_exists('code', $data)) {
            return redirect('/');
        }

        $client_id = config('linkedin-v2.client_id');
        $secret_key = config('linkedin-v2.client_secret');
        $return_url = config('linkedin-v2.redirect_uri');

        $postInput = [
            'grant_type' => 'authorization_code',
            'client_id' => $client_id,
            'client_secret' => $secret_key,
            'redirect_uri' => $return_url,
            'code' => $data['code'],
        ];

        $linkedIn = new LinkedInCustomTokenStore();
        if ($request->has('refresh_token')) {
            $token = $linkedIn->saveToken($postInput, $request->all());
        } else {
            $resp = $linkedIn->getToken($postInput);
            $token = $linkedIn->saveToken($postInput, $resp);
        }
        $message = 'Token is created now!';

        return '<h1>' . $message . '</h1>';
    }

}
