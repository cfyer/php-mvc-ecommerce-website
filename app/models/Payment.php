<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

/**
 * @method static count()
 * @method static create(array $array)
 * @method static where(string $string, $order_id)
 */
class Payment extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $guarded = [];
    protected $dates = ['deleted_at'];
}
