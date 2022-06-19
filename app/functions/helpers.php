<?php

use App\Core\Session;
use App\Models\User;
use Illuminate\Database\Capsule\Manager as DB;
use voku\helper\Paginator;

function paginate($num_of_records, $total_count, $table)
{
    $pages = new Paginator($num_of_records, 'page');
    $pages->set_total($total_count);
    $data = DB::select("SELECT * FROM $table WHERE deleted_at is null ORDER BY created_at DESC" . $pages->get_limit());

    return [
        json_decode(json_encode($data)),
        $pages->page_links()
    ];
}


function dump($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function is_auth()
{
    return Session::has('SESSION_USER_NAME') ? true : false;
}

function user()
{
    if (is_auth()) {
        return User::where('id', Session::get('SESSION_USER_ID'))->first();
    }
    return false;
}
