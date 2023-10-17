<?php

namespace App\Controllers;

use App\Core\{CSRFToken, Request, RequestValidation, Session, View};
use App\Models\User;
use Exception;

class AuthController extends Controller
{
    public function __construct()
    {
		!is_auth() ?: redirect('/');
    }

    public function register(): View
    {
        return View::render()->blade('auth.register');
    }

    /**
     * @throws Exception
     */
    public function registerOperate(): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf);

        RequestValidation::validate($request, [
            'fullname' => ['required' => true],
            'email' => ['required' => true, 'unique' => 'users', 'email' => true],
            'username' => ['required' => true, 'unique' => 'users', 'min' => 5],
            'password' => ['required' => true, 'min' => 6],
            'address' => ['required' => true]
        ]);

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
        redirect('/');
    }

    public function login(): View
    {
        return View::render()->blade('auth.login');
    }

    /**
     * @throws Exception
     */
    public function loginOperate(): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        RequestValidation::validate($request, [
            'username' => ['required' => true],
            'password' => ['required' => true, 'min' => 6]
        ]);

        $userQuery = User::query()->where('username', $request->username);

        if (!$userQuery->exists()) {
            Session::add('invalids', ['User not found']);
            redirect('/login');
        }

        $user = $userQuery->first();

        if (sha1($request->password) !== $user->password) {
            Session::add('invalids', ['Password is invalid']);
            redirect('/login');
        }

        Session::add('SESSION_USER_ID', $user->id);
        Session::add('SESSION_USER_NAME', $user->fullname);
        redirect('/');
    }

    public function logout(): void
    {
        if (is_auth()) {
            Session::remove('SESSION_USER_ID');
            Session::remove('SESSION_USER_NAME');

            if (Session::has('cart')) {
                session_destroy();
            }
        }

        redirect('/login');
    }
}
