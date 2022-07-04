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

    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return View::blade('admin.orders.index', compact('orders'));
    }
}
