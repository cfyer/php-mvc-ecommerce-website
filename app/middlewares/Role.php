<?php

namespace App\Middlewares;

use App\Core\Session;
use App\Models\User;
use App\Utilities\Redirect;

class Role
{
    public static function admin()
    {
        if (!(Session::has('SESSION_USER_ID') && Session::has('SESSION_USER_NAME'))) {
            return Redirect::to('/login');
        }

        $user = User::where('id', Session::get('SESSION_USER_ID'))->first();

        if ($user->role == 'admin') {
            return true;
        }

        return Redirect::to('/');
    }
}
