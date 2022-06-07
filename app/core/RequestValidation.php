<?php

namespace App\Core;

use App\Utilities\Redirect;
use Illuminate\Database\Capsule\Manager as DB;

class RequestValidation
{
    protected static $invalids = [];
    protected static $errors = [
        'required' => 'The :attribute field is required',
        'min' => 'The :attribute must be at least :policy',
        'max' => 'The :attribute must not be greater than :policy',
        'number' => 'The :attribute field cannot contain letters e.g. 20.0, 20',
        'email' => 'Email address is not valid',
        'unique' => 'That :attribute is already taken, please try another one'
    ];

    public static function validate($request, $rules)
    {
        foreach ($request as $field => $value) {
            if (!array_key_exists($field, $rules)) {
                continue;
            }

            foreach ($rules[$field] as $rule => $policy) {
                $operation = self::$rule($field, $value, $policy);
                if (!$operation) {
                    self::invalids($field, $rule, $policy);
                }
            }
        }

        return count(self::$invalids) > 0 ? false : true;
    }

    protected static function invalids($field, $rule, $policy)
    {
        self::$invalids[$field] = str_replace(
            [':attribute', ":policy"],
            [$field, $policy],
            self::$errors[$rule]
        );
    }

    protected static function required($field, $value, $policy)
    {
        if (empty($value) or $value == '' or strlen($value) < 1) {
            return false;
        }

        return true;
    }

    protected static function email($field, $value, $policy)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    protected static function number($field, $value, $policy)
    {
        if (!preg_match('/^[0-9.]+$/', $value)) {
            return false;
        }

        return true;
    }

    protected static function min($field, $value, $policy)
    {
        if (self::number($field, $value, $policy)) {
            return $value >= $policy ? true : false;
        }

        return strlen($value) >= $policy ? true : false;
    }

    protected static function max($field, $value, $policy)
    {
        if (self::number($field, $value, $policy)) {
            return $value <= $policy ? true : false;
        }

        return strlen($value) <= $policy ? true : false;
    }

    protected static function unique($field, $value, $policy)
    {
        return DB::table($policy)->where($field, '!=', $value)->exists();
    }

    public static function sendErrorsAndRedirect($page)
    {
        Session::add('invalids', self::$invalids);
        Redirect::to($page);
    }
}
