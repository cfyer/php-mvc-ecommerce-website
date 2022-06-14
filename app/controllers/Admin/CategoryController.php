<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\CSRFToken;
use App\Core\Request;
use App\Core\RequestValidation;
use App\Core\Session;
use App\Core\View;
use App\Models\Category;
use App\Utilities\Redirect;

class CategoryController extends Controller
{
    protected $count = null;

    public function __construct()
    {
        $this->count = Category::all()->count();
    }

    public function index()
    {
        list($categories, $links) = paginate(10, $this->count, 'categories');
        return View::blade('admin.categories.index', compact('categories','links'));
    }

    public function store()
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf);

        $validation = RequestValidation::validate($request, [
            'name' => ['required' => true, 'unique' => 'categories']
        ]);
        if (!$validation)
            RequestValidation::sendErrorsAndRedirect('/admin/categories');

        Category::create([
            'name' => $request->name,
        ]);

        Session::add('message', 'Category created successfuly');
        return Redirect::to('/admin/categories');
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return View::blade('admin.categories.edit', compact('category'));
    }

    public function update($id)
    {
        $request = Request::get('post');
        CSRFToken::verify($request->csrf);

        $validation = RequestValidation::validate($request, [
            'name' => ['required' => true],
        ]);
        if (!$validation)
            RequestValidation::sendErrorsAndRedirect("/admin/categories/{$id['id']}/edit/");

        $category = Category::where('id', $id)->first();
        $category->update([
            'name' => $request->name,
        ]);

        Session::add('message', 'Category updated successfuly');
        return Redirect::to('/admin/categories');
    }

    public function delete($id)
    {
        $category = Category::where('id', $id)->delete();
        Session::add('message', 'Category deleted successfuly');
        return Redirect::to('/admin/categories');
    }
}
