<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\{Category, Product};

class CategoryController
{
    public function show($id): View
    {
        $category = Category::where('id', $id)->first();

        $products = Product::where('category_id', $category->id)->get();

        return View::render()->blade('client.categories.show', compact('category', 'products'));
    }
}
