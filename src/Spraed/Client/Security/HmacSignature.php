<?php
/**
 * Created by PhpStorm.
 * User: derstoffel
 * Date: 06.03.17
 * Time: 12:44
 */

namespace Spraed\Client\Security;


class HmacSignature
{
    /**
     * @param $requestId
     * @param \DateTime $date
     * @param $apiKey
     * @param $apiSecret
     * @param $nonce
     * @return string
     */
    public static function create($requestId, \DateTime $date, $apiKey, $apiSecret, $nonce)
    {
        $timestamp = $date->format('YmdHis');
        $string = sprintf("%s:%s:%s:%s", $requestId, $timestamp, $apiKey, $nonce);
        $decodedSecret = Base64Url::decode($apiSecret);

        $hash = hash_hmac("sha256", $string, $decodedSecret, true);

        return Base64Url::encode($hash);
    }
}