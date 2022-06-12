<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\CSRFToken;
use App\Core\FileUpload;
use App\Core\Request;
use App\Core\RequestValidation;
use App\Core\Session;
use App\Core\View;
use App\Models\Category;
use App\Models\Product;
use App\Utilities\Redirect;

class ProductController extends Controller
{
    protected $count = null;

    public function __construct()
    {
        $this->count = Product::all()->count();
    }

    public function index()
    {
        list($products, $links) = paginate(10, $this->count, 'products');
        return View::blade('admin.products.index', compact('products', 'links'));
    }

    public function create()
    {
        return View::blade('admin.products.create', [
            'categories' => Category::all()
        ]);
    }

    public function store()
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        $validation = RequestValidation::validate($request, [
            'name' => ['required' => true, 'unique' => 'products'],
            'price' => ['required' => true, 'number' => true, 'min' => 1],
            'quantity' => ['required' => true, 'number' => true, 'min' => 1],
            'category_id' => ['required' => true],
            'description' => ['required' => true],
        ]);

        if (!$validation)
            RequestValidation::sendErrorsAndRedirect('/admin/products/create');

        $image_path = $this->uploadProductImage('/admin/products/create');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'image_path' => $image_path
        ]);

        Session::add('message', 'Product created successfuly');
        return Redirect::to('/admin/products');
    }

    protected function uploadProductImage($page)
    {
        $file = Request::get('file', true);
        $file_name = $file->image->name;

        if (!FileUpload::isImage($file_name)) {
            Session::add('invalids', ['s' => 'The image is invalid']);
            return Redirect::to($page);
        }

        $file_temp = $file->image->tmp_name;
        $image_path = FileUpload::move($file_temp, 'images/products', $file_name)->getPath();

        return $image_path;
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::all();
        return View::blade('admin.products.edit', compact('product', 'categories'));
    }

    public function update($id)
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        $validation = RequestValidation::validate($request, [
            'name' => ['required' => true],
            'price' => ['required' => true, 'number' => true, 'min' => 1],
            'quantity' => ['required' => true, 'number' => true, 'min' => 1],
            'category_id' => ['required' => true],
            'description' => ['required' => true],
        ]);

        if (!$validation)
            RequestValidation::sendErrorsAndRedirect("/admin/products/{$id['id']}/edit/");

        $product = Product::where('id', $id)->first();

        $file = Request::get('file', true);
        $file_name = $file->image->name;
        if (!empty($file_name)) {
            $image_path = $this->uploadProductImage("/admin/products/{$id['id']}/edit/");
        } else {
            $image_path = $product->image_path;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'image_path' => $image_path
        ]);

        Session::add('message', 'Product updated successfuly');
        return Redirect::to('/admin/products');
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        unlink($product->image_path);
        $product->delete();
        Session::add('message', 'Product deleted successfuly');
        return Redirect::to('/admin/products');
    }
}
