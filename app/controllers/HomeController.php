<?php

namespace App\Controllers;

use App\Core\CSRFToken;
use App\Core\Mail;
use App\Core\Request;
use App\Core\RequestValidation;
use App\Core\View;

class HomeController extends Controller
{
    public function index()
    {
        return View::blade('client.index');
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
