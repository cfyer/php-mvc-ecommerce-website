<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\View;
use App\Middlewares\Role;

class DashboardController extends Controller
{
    public function __construct()
    {
        Role::admin();
    }

    public function index(): View
    {
        return View::render()->blade('admin.dashboard');
    }
}
