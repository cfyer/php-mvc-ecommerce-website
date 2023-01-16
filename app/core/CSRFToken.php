<?php

namespace App\Core;

use Exception;

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

    /**
     * @throws Exception
     */
    public static function verify($request_token, $regenerate = true): true
    {
        if (!Session::has('token') or Session::get('token') !== $request_token)
            return throw new Exception("CSRF token is not valid");

        if ($regenerate)
            Session::remove('token');

        return true;
    }
}
