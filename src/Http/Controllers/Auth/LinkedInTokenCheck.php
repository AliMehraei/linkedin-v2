<?php

namespace alimehraei\LinkedInAllInOne\Http\Controllers\Auth;


use Carbon\Carbon;
use Illuminate\Http\Request;
use alimehraei\LinkedInAllInOne\Models\LinkedInToken;

class LinkedInTokenCheck
{

    public static function getToken()
    {
        $zoho_token = LinkedInToken::query()->latest()->first();
        if ($zoho_token) {
            $expiry_time = Carbon::parse($zoho_token->expiry_time);
            if ($expiry_time->lt(Carbon::now())) {
                $zoho = new LinkedInCustomTokenStore();
                $zoho_token = $zoho->refreshToken($zoho_token->id);
            }
            return $zoho_token;
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


        $client_id = config('linkedin-v2.client_id');
        $secret_key = config('linkedin-v2.client_secret');
        $z_url = config('linkedin-v2.accounts_url');
        $z_return_url = config('linkedin-v2.redirect_uri');
        $z_api_url = config('linkedin-v2.api_base_url');
        $z_current_user_email = config('linkedin-v2.current_user_email');

        $postInput = [
            'grant_type' => 'authorization_code',
            'client_id' => $client_id,
            'client_secret' => $secret_key,
            'redirect_uri' => $z_return_url,
            'code' => $data['code'],
        ];
        $zoho = new LinkedInCustomTokenStore();
        if ($request->has('refresh_token')) {
            $token = $zoho->saveToken($postInput, $request->all(), $client_id, $secret_key, $z_return_url);
        } else {
            $resp = $zoho->getToken($data['accounts-server'], $data['location'], $postInput);
            $token = $zoho->saveToken($postInput, $resp, $client_id, $secret_key, $z_return_url);
        }
        $message = 'Token is created now!';

        return '<h1>' . $message . '</h1>';
    }

}
