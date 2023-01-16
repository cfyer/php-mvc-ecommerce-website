<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\{CSRFToken, Request, RequestValidation, Session, View};
use App\Middlewares\Role;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{
    protected int $count;

    public function __construct()
    {
        Role::admin();

        $this->count = Category::all()->count();
    }

    public function index(): View
    {
        list($categories, $links) = paginate(10, $this->count, 'categories');

        return View::render()->blade('admin.categories.index', compact('categories','links'));
    }

    /**
     * @throws Exception
     */
    public function store(): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        RequestValidation::validate($request, [
            'name' => ['unique' => 'categories', 'required' => true]
        ]);

        Category::create(['name' => $request->name]);

        Session::add('message', 'Category created successfully');
        redirect('/admin/categories');
    }

    public function edit($id): View
    {
        $category = Category::where('id', $id)->first();

        return View::render()->blade('admin.categories.edit', compact('category'));
    }

    /**
     * @throws Exception
     */
    public function update($id): void
    {
        $request = Request::get('post');
        CSRFToken::verify($request->csrf);

        RequestValidation::validate($request, [
            'name' => ['required' => true],
        ]);

        $category = Category::where('id', $id)->first();

        $category->update(['name' => $request->name,]);

        Session::add('message', 'Category updated successfully');
        redirect('/admin/categories');
    }

    public function delete( $id): void
    {
        Category::where('id', $id)->delete();

        Session::add('message', 'Category deleted successfully');

        redirect('/admin/categories');
    }
}
