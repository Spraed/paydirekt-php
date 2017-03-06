<?php

namespace Spraed\Client;


final class ApiEndpoints
{
    const BASE_URL = 'https://api.paydirekt.de';
    const SANDBOX_BASE_URL = 'https://api.sandbox.paydirekt.de';

    const OBTAIN_TOKEN = '/api/merchantintegration/v1/token/obtain';
    const CHECKOUT = '/api/checkout/v1/checkouts';

    public static function getBaseUrl($sandbox = false)
    {
        return $sandbox ? self::SANDBOX_BASE_URL : self::BASE_URL;
    }
}