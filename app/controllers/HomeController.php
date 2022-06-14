<?php

namespace App\Controllers;

use App\Core\CSRFToken;
use App\Core\Mail;
use App\Core\Request;
use App\Core\View;
use App\Models\Product;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->limit(8)->get();
        $slides = Slider::orderBy('id', 'DESC')->limit(3)->get();
        return View::blade('client.index', compact('products', 'slides'));
    }

    public function sendTestMail()
    {
        $result = Mail::send('welcome', [
            'to' => 'test@mail.com',
            'name' => 'john',
            'subject' => 'welcome'
        ]);
        var_dump($result);
    }
}
