<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Category;
use App\Models\Product;

class CategoryController
{
    public function show($id)
    {
        $category = Category::where('id', $id)->first();
        $products = Product::where('category_id', $category->id)->get();
        return View::blade('client.categories.show', compact('category', 'products'));
    }
}
