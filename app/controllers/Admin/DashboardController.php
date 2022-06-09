<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\View;

class DashboardController extends Controller
{
    public function index()
    {
        return View::blade('admin.dashboard');
    }
}
