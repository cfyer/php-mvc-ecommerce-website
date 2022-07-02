<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\CSRFToken;
use App\Core\Request;
use App\Core\RequestValidation;
use App\Core\Session;
use App\Core\View;
use App\Models\User;
use App\Utilities\Redirect;

class UserController extends Controller
{
    protected $count = null;

    public function __construct()
    {
        $this->count = User::count();
    }

    public function index()
    {
        list($users, $links) = paginate('10', $this->count, 'users');
        return View::blade('admin.users.index', compact('users', 'links'));
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return View::blade('admin.users.edit', compact('user'));
    }

    public function update($id)
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        $validation = RequestValidation::validate($request, [
            'fullname' => ['required' => true],
            'username' => ['required' => true],
            'role' => ['required' => true],
        ]);

        if (!$validation)
            RequestValidation::sendErrorsAndRedirect("/admin/users/{$id['id']}/edit/");

        $user = User::where('id', $id)->first();

        $user->update([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'role' => $request->role,
        ]);

        Session::add('message', 'User updated successfuly');
        return Redirect::to('/admin/users');
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        Session::add('message', 'User deleted');
        return Redirect::to('/admin/users');
    }
}
