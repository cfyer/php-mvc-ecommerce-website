<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Core\View;
use App\Middlewares\Role;
use App\Models\Payment;

class PaymentController extends Controller
{
    protected int $count;

    function __construct()
    {
        Role::admin();
        $this->count = Payment::count();
    }

    public function index()
    {
        list($payments, $links) = paginate(10, $this->count, 'payments');
        return View::blade('admin.payments.index', compact('payments', 'links'));
    }
}
