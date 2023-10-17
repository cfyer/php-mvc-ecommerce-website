<?php

namespace App\Core;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class ErrorHandler
{
    public function __construct()
    {
        if ($_ENV['APP_MODE'] === 'production') {
            $this->production();
        }else{
            $this->local();
        }
    }

    protected function local(): void
    {
        $whoops = new Run;
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();
    }

    protected function production(): void
    {
        ini_set('display_errors', 0);
    }
}
