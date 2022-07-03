<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $fillable = ['username', 'fullname', 'email', 'password', 'address', 'role'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
