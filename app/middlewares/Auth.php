<?php

namespace App\Middlewares;

use App\Core\Session;

class Auth
{
    public static function check(): void
    {
        if (!(Session::has('SESSION_USER_ID') && Session::has('SESSION_USER_NAME'))) {
            redirect('/login');
        }
    }
}
