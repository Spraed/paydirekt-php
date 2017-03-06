<?php

namespace Spraed\Client\Security;

/**
 * Creates a random alpha numeric string
 * Base64Url encoded
 *
 * @author derstoffel <derstoffel@posteo.de>
 */
final class Nonce
{
    /**
     * @param integer $length
     * @return string
     */
    public static function create($length)
    {
        $bytes = random_bytes($length);

        return Base64Url::encode($bytes);
    }
}