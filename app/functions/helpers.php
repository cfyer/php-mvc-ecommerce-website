<?php

use App\Core\Session;
use App\Core\View;
use App\Models\User;
use Illuminate\Database\Capsule\Manager as DB;
use JetBrains\PhpStorm\NoReturn;
use voku\helper\Paginator;

function paginate($num_of_records, $total_count, $table): array|null
{
    $pages = new Paginator($num_of_records, 'page');
    $pages->set_total($total_count);
    $data = DB::select("SELECT * FROM $table WHERE deleted_at is null ORDER BY created_at DESC" . $pages->get_limit());

    return [
        json_decode(json_encode($data)),
        $pages->page_links()
    ];
}

#[NoReturn]
function dump($data): void
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die;
}

function is_auth(): bool
{
    return Session::has('SESSION_USER_NAME');
}

function user()
{
    if (is_auth()) {
        return User::query()->where('id', Session::get('SESSION_USER_ID'))->first();
    }
    return false;
}

function redirect(string $page): void
{
    header("location: $page");
}