<?php

namespace App\Controllers;

use App\Core\CSRFToken;
use App\Core\View;
use App\Models\Product;

class ProductController extends Controller
{
    protected $count;

    function __construct()
    {
        $this->count = Product::all()->count();
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        $similarProducts = Product::query()->where('category_id', $product->category->id)->orderBy('id','DESC')->limit(4)->get();
        return View::blade('client.products.show', compact('product', 'similarProducts'));
    } 
}
