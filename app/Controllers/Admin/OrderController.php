<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\View;
use App\Middlewares\Role;
use App\Models\Order;

class OrderController extends Controller
{
    function __construct()
    {
        Role::admin();
    }

    public function index(): View
    {
        $orders = Order::query()->orderBy('id', 'DESC')->get();

        return View::render()->blade('admin.orders.index', compact('orders'));
    }
}
