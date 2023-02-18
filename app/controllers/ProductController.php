<?php

namespace App\Controllers;

use App\Core\{Request, View};
use App\Models\Product;

class ProductController extends Controller
{
    protected int $count;

    function __construct()
    {
        $this->count = Product::all()->count();
    }

    public function index(): View
    {
        list($products, $links) = paginate(8, $this->count, 'products');

        if (Request::has('get')) {
            $request = Request::get('get');
            $products = Product::where('name', 'LIKE', '%' . $request->key . '%')->get();
        }

        return View::render()->blade('client.products.index', compact('products', 'links'));
    }

    public function show($id): View
    {
        $product = Product::where('id', $id)->first();

        $similarProducts = Product::query()->where('category_id', $product->category->id)->orderBy('id', 'DESC')->limit(4)->get();

        return View::render()->blade('client.products.show', compact('product', 'similarProducts'));
    }
}
