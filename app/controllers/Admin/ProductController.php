<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\{CSRFToken, FileUpload, RequestValidation, Request, Session, View};
use App\Middlewares\Role;
use App\Models\{Category, Product};
use Exception;

class ProductController extends Controller
{
    protected ?int $count = null;

    public function __construct()
    {
        Role::admin();
        $this->count = Product::all()->count();
    }

    public function index(): View
    {
        list($products, $links) = paginate(10, $this->count, 'products');

        return View::render()->blade('admin.products.index', compact('products', 'links'));
    }

    public function create(): View
    {
        $categories = Category::all();

        return View::render()->blade('admin.products.create', compact('categories'));
    }

    /**
     * @throws Exception
     */
    public function store(): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        RequestValidation::validate($request, [
            'name' => ['required' => true, 'unique' => 'products'],
            'price' => ['required' => true, 'number' => true, 'min' => 1],
            'quantity' => ['required' => true, 'number' => true, 'min' => 1],
            'category_id' => ['required' => true],
            'description' => ['required' => true],
        ]);

        $image_path = $this->uploadProductImage();

        if (!$image_path) {
            Session::add('invalids', ['s' => 'The image is invalid']);
            redirect('/admin/products/create');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'image_path' => $image_path
        ]);

        Session::add('message', 'Product created successfully');

        redirect('/admin/products');
    }

    protected function uploadProductImage(): false|string
    {
        $file = Request::get('file');
        $file_name = $file->image->name;

        if (empty($file_name) or $file_name == "" or strlen($file_name) < 1) {
            return false;
        }

        if (!FileUpload::isImage($file_name)) {
            return false;
        }

        $file_temp = $file->image->tmp_name;

        return FileUpload::move($file_temp, 'images/products', $file_name)->getPath();
    }

    public function edit($id): View
    {
        $product = Product::where('id', $id)->first();

        $categories = Category::all();

        return View::render()->blade('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * @throws Exception
     */
    public function update($id): void
    {
        $request = Request::get('post');

        CSRFToken::verify($request->csrf, false);

        RequestValidation::validate($request, [
            'name' => ['required' => true],
            'price' => ['required' => true, 'number' => true, 'min' => 1],
            'quantity' => ['required' => true, 'number' => true, 'min' => 1],
            'category_id' => ['required' => true],
            'description' => ['required' => true],
        ]);

        $product = Product::where('id', $id)->first();

        $file = Request::get('file');
        $file_name = $file->image->name;
        if (!empty($file_name)) {
            $image_path = $this->uploadProductImage();
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

        Session::add('message', 'Product updated successfully');

        redirect('/admin/products');
    }

    public function delete($id): void
    {
        $product = Product::where('id', $id)->first();

        unlink($product->image_path);

        $product->delete();

        Session::add('message', 'Product deleted successfully');

        redirect('/admin/products');
    }
}
