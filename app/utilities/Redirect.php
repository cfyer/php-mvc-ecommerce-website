<?php

namespace App\Utilities;

class Redirect
{
    public static function to($page)
    {
        header("location: $page");
    }
}
