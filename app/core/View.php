<?php

namespace App\Core;

use Jenssegers\Blade\Blade;

class View
{
    private string $path = BASE_PATH . "/resources/views/";
    private string $cache = BASE_PATH . "/resources/cache/";

    private static $obj;

    public static function render(): View
    {
        if (static::$obj == null or !isset(static::$obj) or empty(static::$obj)){
            static::$obj = new static();
        }

        return static::$obj;
    }

    public function blade($viewname, $arguments = []): View
    {
        $blade = new Blade($this->path, $this->cache);

        echo $blade->make($viewname, $arguments)->render();

        return $this;
    }

    public function mail($viewname, $arguments = []): false|string
    {
        extract($arguments);
        ob_start();
        include $this->path . '/mails/' . $viewname . '.php';
        $content = ob_get_contents();
        ob_clean();
        return $content;
    }
}
