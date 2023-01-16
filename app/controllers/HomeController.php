<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\{Product, Slider};

class HomeController extends Controller
{
    public function index(): View
    {
        $products = Product::orderBy('id', 'DESC')->limit(4)->get();

        $slides = Slider::orderBy('id', 'DESC')->limit(3)->get();

        return View::render()->blade('client.index', compact('products', 'slides'));
    }
}
