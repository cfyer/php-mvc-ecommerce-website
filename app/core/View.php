<?php

namespace App\Core;

use Philo\Blade\Blade;

class View
{
    protected static $path = BASE_PATH . "/resources/views/";
    protected static $cache = BASE_PATH . "/resources/cache/";

    public static function blade($viewname, $arguments = [])
    {
        $blade = new Blade(self::$path, self::$cache);
        echo $blade->view()->make($viewname, $arguments)->render();
    }
}
