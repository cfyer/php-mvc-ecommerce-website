<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as DB;

class RequestValidation
{
    protected static array $invalids = [];
    protected static $errors = [
        'min' => 'The :attribute must be at least :policy',
        'max' => 'The :attribute must not be greater than :policy',
        'number' => 'The :attribute field cannot contain letters e.g. 20.0, 20',
        'email' => 'Email address is not valid',
        'unique' => 'That :attribute is already taken, please try another one',
        'required' => 'The :attribute field is required',
        'minLen' => 'The :attribute must be at least :policy characters',
    ];

    public static function validate($request, $rules): void
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

        if (count(self::$invalids) > 0){
            self::sendErrorsAndRedirect($_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    protected static function invalids($field, $rule, $policy): void
    {
        self::$invalids[$field] = str_replace(
            [':attribute', ":policy"],
            [$field, $policy],
            self::$errors[$rule]
        );
    }

    protected static function required($field, $value, $policy): bool
    {
        if (empty($value) or $value == '' or strlen($value) < 1) {
            return false;
        }

        return true;
    }

    protected static function email($field, $value, $policy): bool
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    protected static function number($field, $value, $policy): bool
    {
        if (!preg_match('/^[0-9.]+$/', $value)) {
            return false;
        }

        return true;
    }

    protected static function min($field, $value, $policy): bool
    {
        if (self::number($field, $value, $policy)) {
            return $value >= $policy;
        }

        return strlen($value) >= $policy;
    }

    protected static function minLen($field, $value, $policy): bool
    {
        return strlen($value) >= $policy;
    }

    protected static function max($field, $value, $policy): bool
    {
        if (self::number($field, $value, $policy)) {
            return $value <= $policy;
        }

        return strlen($value) <= $policy;
    }

    protected static function unique($field, $value, $policy): bool
    {
        return !DB::table($policy)->where($field, $value)->exists();
    }

    public static function sendErrorsAndRedirect($page): void
    {
        Session::add('invalids', self::$invalids);
        redirect($page);
    }
}
