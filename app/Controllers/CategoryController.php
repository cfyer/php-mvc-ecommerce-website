<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\{Category, Product};

class CategoryController extends Controller
{
    public function show($id): View
    {
        $category = Category::query()->where('id', $id)->first();

        $products = Product::query()->where('category_id', $category->id)->get();

        return View::render()->blade('client.categories.show', compact('category', 'products'));
    }
}
