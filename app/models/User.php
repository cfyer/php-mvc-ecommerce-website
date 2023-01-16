<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, Relations\HasMany, SoftDeletes};

/**
 * @method static where(string $string, mixed $get)
 * @method static count()
 * @method static create(array $array)
 */
class User extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $fillable = ['username', 'fullname', 'email', 'password', 'address', 'role'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
