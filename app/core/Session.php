<?php

namespace App\Core;

class Session
{
    public static function add(string $name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function has($name)
    {
        return isset($_SESSION[$name]) ? true : false;
    }

    public static function get($name)
    {
        if (self::has($name))
            return $_SESSION[$name];

        return null;
    }

    public static function remove($name)
    {
        if (self::has($name))
            unset($_SESSION[$name]);
    }
}
