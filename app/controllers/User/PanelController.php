<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Core\{CSRFToken, Request, RequestValidation, Session, View};
use App\Middlewares\Auth;
use Exception;
use App\Models\{Order, User};

class PanelController extends Controller
{
    public function __construct()
    {
        Auth::check();
    }

    public function index(): View
    {
        $user = User::where('id', Session::get('SESSION_USER_ID'))->first();

        return View::render()->blade('user.panel.index', compact('user'));
    }

    public function edit($id): View
    {
        $user = User::where('id', $id)->first();

        return View::render()->blade('user.panel.edit', compact('user'));
    }

    /**
     * @throws Exception
     */
    public function update($id): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf);

        RequestValidation::validate($request, [
            'username' => ['required' => true],
            'fullname' => ['required' => true],
            'address' => ['required' => true],
        ]);

        $user = User::where('id', $id)->first();

        $user->update([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'address' => $request->address
        ]);

        Session::add('message', 'profile updated successfully');
        redirect('/panel');
    }

    public function editPassword($id): View
    {
        $user = User::where('id', $id)->first();

        return View::render()->blade('user.panel.password', compact('user'));
    }

    /**
     * @throws Exception
     */
    public function updatePassword($id): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        RequestValidation::validate($request, [
            'oldPassword' => ['required' => true, 'min' => 6],
            'newPassword' => ['required' => true, 'min' => 6],
        ]);

        $user = User::where('id', $id)->first();

        if (sha1($request->oldPassword) !== $user->password) {
            Session::add('invalids', ['old password incorrect']);
            redirect("/panel/{$id['id']}/edit/password");
        }

        $user->update([
            'password' => sha1($request->newPassword)
        ]);

        Session::add('message', 'password updated');
        redirect("/panel");
    }

    public function orders($userid): View
    {
        $orders = Order::where('user_id', $userid)->get();

        return View::render()->blade('user.orders.index', compact('orders'));
    }
}
