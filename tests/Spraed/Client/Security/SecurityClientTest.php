<?php

use Spraed\Client\Security\SecurityClient;

/**
 * Created by PhpStorm.
 * User: derstoffel
 * Date: 06.03.17
 * Time: 12:01
 */
class SecurityClientTest extends \PHPUnit\Framework\TestCase
{
    public function testGetAccessToken()
    {
        $apiKey = "e81d298b-60dd-4f46-9ec9-1dbc72f5b5df";
        $apiSecret = "GJlN718sQxN1unxbLWHVlcf0FgXw2kMyfRwD0mgTRME=";

        $client = new SecurityClient($apiKey, $apiSecret);
        $response = $client->getAccessToken();
        $arrayResponseBody = json_decode($response->getContents(), true);

        self::assertArrayHasKey('access_token', $arrayResponseBody);
        self::assertArrayHasKey('expires_in', $arrayResponseBody);
        self::assertNotNull($arrayResponseBody['access_token']);
        self::assertNotNull($arrayResponseBody['expires_in']);
    }
}
