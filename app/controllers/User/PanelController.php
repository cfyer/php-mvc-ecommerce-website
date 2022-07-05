<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Core\CSRFToken;
use App\Core\Request;
use App\Core\RequestValidation;
use App\Core\Session;
use App\Core\View;
use App\Middlewares\Auth;
use App\Models\Order;
use App\Models\User;
use App\Utilities\Redirect;

class PanelController extends Controller
{
    public function __construct()
    {
        Auth::check();
    }

    public function index()
    {
        $user = User::where('id', Session::get('SESSION_USER_ID'))->first();

        return View::blade('user.panel.index', compact('user'));
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        return View::blade('user.panel.edit', compact('user'));
    }

    public function update($id)
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf);

        $validation = RequestValidation::validate($request, [
            'username' => ['required' => true],
            'fullname' => ['required' => true],
            'address' => ['required' => true],
        ]);

        if (!$validation) {
            RequestValidation::sendErrorsAndRedirect("/panel/{$id['id']}/edit");
        }

        $user = User::where('id', $id)->first();

        $user->update([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'address' => $request->address
        ]);

        Session::add('message', 'profile updated successfully');
        return Redirect::to('/panel');
    }

    public function editPassword($id)
    {
        $user = User::where('id', $id)->first();

        return View::blade('user.panel.password', compact('user'));
    }

    public function updatePassword($id)
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        $validation = RequestValidation::validate($request, [
            'oldPassword' => ['required' => true, 'min' => 6],
            'newPassword' => ['required' => true, 'min' => 6],
        ]);

        if (!$validation) {
            RequestValidation::sendErrorsAndRedirect("/panel/{$id['id']}/edit/password");
        }

        $user = User::where('id', $id)->first();

        if (sha1($request->oldPassword) !== $user->password) {
            Session::add('invalids', ['old password incorrect']);
            return Redirect::to("/panel/{$id['id']}/edit/password");
        }

        $user->update([
            'password' => sha1($request->newPassword)
        ]);

        Session::add('message', 'password updated');
        return Redirect::to("/panel");
    }

    public function orders($userid)
    {
        $orders = Order::where('user_id', $userid)->get();

        return View::blade('user.orders.index', compact('orders'));
    }
}
