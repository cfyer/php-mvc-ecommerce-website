<?php

namespace App\Core;

class Request
{
    public static function all($is_array = false)
    {
        $request = [];

        if (count($_POST) > 0)
            $request['post'] = $_POST;

        if (count($_GET) > 0)
            $request['get'] = $_GET;

        $request['file'] = $_FILES;

        return json_decode(json_encode($request), $is_array);
    }

    public static function get($key)
    {
        $request = self::all();
        return $request->$key;
    }

    public static function has($key)
    {
        if (array_key_exists($key, self::all(true)))
            return true;

        return false;
    }

    public static function old($key, $value)
    {
        $data = self::all();
        return isset($data->$key->$value) ? $data->$key->$value : '';
    }
}
