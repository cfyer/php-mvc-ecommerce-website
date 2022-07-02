<?php

namespace App\Controllers;

use App\Core\CSRFToken;
use App\Core\Request;
use App\Core\RequestValidation;
use App\Core\Session;
use App\Core\View;
use App\Models\User;
use App\Utilities\Redirect;

class AuthController
{
    public function __construct()
    {
        if (is_auth()) {
            return Redirect::to('/');
        }
    }

    public function register()
    {
        return View::blade('auth.register');
    }

    public function registerOperate()
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf);

        $validation = RequestValidation::validate($request, [
            'fullname' => ['required' => true],
            'email' => ['required' => true, 'unique' => 'users', 'email' => true],
            'username' => ['required' => true, 'unique' => 'users', 'min' => 5],
            'password' => ['required' => true, 'min' => 6],
            'address' => ['required' => true]
        ]);

        if (!$validation)
            RequestValidation::sendErrorsAndRedirect('/register');

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'fullname' => $request->fullname,
            'password' => sha1($request->password),
            'address' => $request->address,
            'role' => 'user',
        ]);

        $user = User::where('username', $request->username)->first();

        Session::add('SESSION_USER_ID', $user->id);
        Session::add('SESSION_USER_NAME', $user->fullname);
        return Redirect::to('/');
    }

    public function login()
    {
        return View::blade('auth.login');
    }

    public function loginOperate()
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        $validation = RequestValidation::validate($request, [
            'username' => ['required' => true],
            'password' => ['required' => true, 'min' => 6]
        ]);
        if (!$validation)
            RequestValidation::sendErrorsAndRedirect('/login');

        $userQuery = User::where('username', $request->username);

        if (!$userQuery->exists()) {
            Session::add('invalids', ['User not found']);
            return Redirect::to('/login');
        }

        $user = $userQuery->first();

        if (sha1($request->password) !== $user->password) {
            Session::add('invalids', ['Password is invalid']);
            return Redirect::to('/login');
        }

        Session::add('SESSION_USER_ID', $user->id);
        Session::add('SESSION_USER_NAME', $user->fullname);
        return Redirect::to('/');
    }

    public function logout()
    {
        if (is_auth()) {
            Session::remove('SESSION_USER_ID');
            Session::remove('SESSION_USER_NAME');

            if (Session::has('cart')) {
                session_destroy();
            }
        }

        return Redirect::to('/login');
    }
}
