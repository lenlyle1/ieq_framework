<?php

namespace App\Lib\User\Traits;

trait CreateSingleUseTokenTrait
{
    public static function createToken($length)
    {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}