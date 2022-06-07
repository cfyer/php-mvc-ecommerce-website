<?php

namespace App\Core;

class CSRFToken
{
    public static function _token()
    {
        if (!Session::has('token')) {
            $key = base64_encode(openssl_random_pseudo_bytes(32));
            Session::add('token', $key);
        }

        return Session::get('token');
    }

    public static function verify($requet_token, $regenerate = true)
    {
        if (!Session::has('token') or Session::get('token') !== $requet_token)
            return false;

        if ($regenerate)
            Session::remove('token');

        return true;
    }
}
