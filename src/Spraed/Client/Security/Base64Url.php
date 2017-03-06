<?php

namespace Spraed\Client\Security;

/**
 * Base64Url encoding and decoding after RFC 4648 Section 5
 *
 * @author derstoffel <derstoffel@posteo.de>
 */
final class Base64Url
{
    /**
     * @param string $plainText
     * @return string
     */
    public static function encode($plainText)
    {
        $base64 = base64_encode($plainText);

        return strtr($base64, '+/', '-_');
    }

    /**
     * @param string $encodedText
     * @return string
     */
    public static function decode($encodedText)
    {
        return base64_decode(str_pad(strtr($encodedText, '-_', '+/'), strlen($encodedText) % 4, '=', STR_PAD_RIGHT));
    }
}