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

    public static function mail($viewname, $arguments = [])
    {
        extract($arguments);
        ob_start();
        include self::$path . '/mails/' . $viewname . '.php';
        $content = ob_get_contents();
        ob_clean();
        return $content;
    }
}
