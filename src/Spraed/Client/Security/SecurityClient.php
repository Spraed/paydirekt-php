<?php

namespace Spraed\Client\Security;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Ramsey\Uuid\Uuid;
use Spraed\Client\ApiEndpoints;

/**
 * The client authenticates against the security end point of the API
 * and provides a necessary access-token
 *
 * @author derstoffel <derstoffel@posteo.de>
 */
class SecurityClient
{
    const HEADER_AUTH_KEY = 'X-Auth-Key';
    const HEADER_AUTH_CODE = 'X-Auth-Code';
    const HEADER_REQUEST_ID = 'X-Request-ID';
    const HEADER_DATE = 'X-Date';
    const HEADER_CONTENT_TYPE = 'Content-Type';
    const HEADER_ACCEPT = 'Accept';
    const BODY_GRANT_TYPE = 'grantType';
    const BODY_RANDOM_NONCE = 'randomNonce';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $apiSecret;

    /**
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct($apiKey, $apiSecret)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getAccessToken()
    {
        $uuid = Uuid::uuid4();
        $date = new \DateTime("now", new \DateTimeZone('UTC'));
        $nonce = Nonce::create(48);

        $signature = HmacSignature::create($uuid, $date, $this->apiKey, $this->apiSecret, $nonce);

        $client = new Client();
        $headers = [
            self::HEADER_AUTH_KEY => $this->apiKey,
            self::HEADER_AUTH_CODE => $signature,
            self::HEADER_REQUEST_ID => $uuid,
            self::HEADER_DATE => $date->format(DATE_RFC1123),
            self::HEADER_CONTENT_TYPE => 'application/hal+json;charset=utf-8',
            self::HEADER_ACCEPT => 'application/hal+json',
        ];
        $body = json_encode([
            self::BODY_GRANT_TYPE => 'api_key',
            self::BODY_RANDOM_NONCE => $nonce,
        ]);

        $request = new Request('POST', ApiEndpoints::getBaseUrl(true) . ApiEndpoints::OBTAIN_TOKEN, $headers, $body);
        $response = $client->send($request);

        return $response->getBody();
    }
}
