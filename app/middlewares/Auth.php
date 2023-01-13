<?php

namespace App\Middlewares;

use App\Core\Session;

class Auth
{
    public static function check()
    {
        if (!(Session::has('SESSION_USER_ID') && Session::has('SESSION_USER_NAME'))) {
            return redirect('/login');
        }

        return true;
    }
}
