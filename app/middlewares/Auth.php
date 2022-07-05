<?php

namespace App\Middlewares;

use App\Core\Session;
use App\Utilities\Redirect;

class Auth
{
    public static function check()
    {
        if (!(Session::has('SESSION_USER_ID') && Session::has('SESSION_USER_NAME'))) {
            return Redirect::to('/login');
        }

        return true;
    }
}
