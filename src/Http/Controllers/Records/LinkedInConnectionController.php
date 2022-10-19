<?php

namespace alimehraei\LinkedInAllInOne\Http\Controllers\Records;

use GuzzleHttp\Client;
use alimehraei\LinkedInAllInOne\Http\Controllers\Auth\LinkedInTokenCheck;

class LinkedInConnectionController
{


    public static function test()
    {
        $token = LinkedInTokenCheck::getToken();
        if (!$token) {
            return null;
        }
        $apiURL = 'https://api.linkedin.com/v2/emailAddress';

        $client = new Client();

        $headers = [
            'Authorization' => "Bearer $token->access_token",
           // 'Content-Type' => 'application/json',
        ];

        $response = $client->request('GET', $apiURL, ['headers' => $headers]);
        $statusCode = $response->getStatusCode();
        $responseBody = json_decode($response->getBody(), true);
        return $responseBody;
    }


}
