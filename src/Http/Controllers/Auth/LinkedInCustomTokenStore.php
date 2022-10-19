<?php

namespace alimehraei\LinkedInAllInOne\Http\Controllers\Auth;

use com\zoho\api\authenticator\Token;
use com\zoho\crm\api\exception\SDKException;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use alimehraei\LinkedInAllInOne\Models\LinkedInToken;

class LinkedInCustomTokenStore
{
    /**
     * @param $account_url
     * @param $location
     * @param $postInput
     * @return A Token class instance representing the user token details.
     */
    public function getToken($postInput)
    {
        $apiURL = 'https://www.linkedin.com/oauth/v2/accessToken';
        $client = new Client();
        $response = $client->request('POST', $apiURL, ['form_params' => $postInput, 'headers' => ['Content-Type' => 'application/x-www-form-urlencoded']]);
        $statusCode = $response->getStatusCode();
        $responseBody = json_decode($response->getBody(), true);
        return $responseBody;
    }

    /**
     * @param $postInput
     * @param $response
     * @param $client_id
     * @param $secret_key
     * @param $z_return_url
     * @return LinkedInToken
     */
    public function saveToken($postInput, $response)
    {
        $token = new LinkedInToken();
        $token->access_token = $response['access_token'];
        $token->refresh_token = $response['refresh_token'] ?? '';
        $token->api_domain = $response['api_domain'] ?? null;
        $token->token_type = $response['token_type'] ?? null;
        $now = Carbon::now();
        $token->expiry_time = $now->add($response['expires_in'], 'seconds');
        $token->grant_token = $postInput['code'];
        $token->client_id = $postInput['client_id'];
        $token->client_secret = $postInput['client_secret'];
        $token->save();
        return $token;
    }

    /**
     * @param token A Token (com\zoho\api\authenticator\OAuthToken) class instance.
     * @throws SDKException if any problem occurs.
     */
    public function deleteToken($token)
    {
        // Add code to delete the token
    }

    /**
     * @return array  An array of Token (com\zoho\api\authenticator\OAuthToken) class instances
     */
    public function getTokens()
    {
        //Add code to retrieve all the stored tokens
    }

    public function deleteTokens()
    {
        //Add code to delete all the stored tokens.
    }

    public function refreshToken($token_id)
    {
        $token = LinkedInToken::find($token_id);
        $postInput = [
            'refresh_token' => $token->refresh_token,
            'client_id' => $token->client_id,
            'client_secret' => $token->client_secret,
            'grant_type' => 'refresh_token',
        ];
        $z_url = config('linkedin-v2.accounts_url');
        $z_return_url = config('linkedin-v2.redirect_uri');
        $z_api_url = config('linkedin-v2.api_base_url');

        $refreshed_token_resp = self::getToken($z_url, config('linkedin-v2.location'), $postInput);

        //check the error response
        if (array_key_exists('error', $refreshed_token_resp ?? [])) {
            return null;
        }
        $token->access_token = $refreshed_token_resp['access_token'];
        $now = Carbon::now();
        $token->expiry_time = $now->add($refreshed_token_resp['expires_in'], 'seconds');
        $token->save();
        return $token;
    }

    /**
     * @param $id
     * @param $token
     * @return A Token class instance representing the user token details.
     */
    public function getTokenById($id, $token)
    {
        // Add code to get the token using unique id
        return null;
    }
}
