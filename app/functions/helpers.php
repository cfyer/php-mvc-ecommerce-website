<?php

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
