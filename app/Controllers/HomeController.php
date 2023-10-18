<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\{Product, Slider};

class HomeController extends Controller
{
    public function index(): View
    {
        $products = Product::query()->orderByDesc('id')->limit(4)->get();

        $slides = Slider::query()->orderByDesc('id')->limit(3)->get();

        return View::render()->blade('client.index', compact('products', 'slides'));
    }
}
