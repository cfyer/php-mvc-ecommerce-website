<?php

namespace App\Middlewares;

use App\Core\Session;
use App\Models\User;

class Role
{
    public static function admin(): void
    {
        if (!(Session::has('SESSION_USER_ID') and Session::has('SESSION_USER_NAME'))) {
            redirect('/login');
        }

        $user = User::query()->where('id', Session::get('SESSION_USER_ID'))->first();

        if ($user->role <> 'admin') {
            redirect('/');
        }
    }
}
