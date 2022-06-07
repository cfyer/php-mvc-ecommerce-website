<?php

namespace App\Core;

use Whoops\Handler\PrettyPageHandler;

class ErrorHandler
{
    public function __construct()
    {
        if ($_ENV['APP_MODE'] === 'production') {
            $this->production();
            die;
        }

        $this->local();
    }

    protected function local()
    {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();
    }

    protected function production()
    {
        ini_set('display_errors', 0);
    }
}
