<?php

namespace App\Controllers;

use App\Core\View;

class HomeController extends Controller
{
    public function index()
    {
        return View::blade('client.index');
    }
}
