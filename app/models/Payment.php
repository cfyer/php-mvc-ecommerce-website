<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = ['deleted_at'];
}