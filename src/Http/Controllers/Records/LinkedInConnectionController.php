<?php

namespace alimehraei\LinkedInAllInOne\Http\Controllers\Records;

use GuzzleHttp\Client;
use alimehraei\LinkedInAllInOne\Http\Controllers\Auth\LinkedInTokenCheck;

class LinkedInConnectionController
{


    public static function getAll($page_token = null)
    {
        $token = LinkedInTokenCheck::getToken();
        if (!$token) {
            return null;
        }
        $apiURL = $token->api_domain . '/crm/v3/Contacts?fields=Title,Contact_Type,Department,Rating,Phone,Fax,Date_of_Birth,Other_Phone,Secondary_Email,Skype_ID,LinkedIn,Mailing_Street,Mailing_City,Mailing_Zip,Mailing_State,Mailing_Country,Description,Last_Activity_Date,Private_Email,Email,First_Name,Last_Name,Mobile,Vendor_Name,Account_Name';
        if ($page_token) {
            $apiURL .= '&page_token=' . $page_token;
        }
        $client = new Client();

        $headers = [
            'Authorization' => 'Zoho-oauthtoken ' . $token->access_token,
        ];

        $response = $client->request('GET', $apiURL, ['headers' => $headers]);
        $statusCode = $response->getStatusCode();
        $responseBody = json_decode($response->getBody(), true);
        return $responseBody;
    }


}
