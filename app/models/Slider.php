<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;
    public $table = 'slides';
    public $timestamps = true;
    protected $fillable = ['image_path', 'link', 'is_active'];
    protected $dates = ['deleted_at'];

    public static function countActiveSlides($id)
    {
        return static::query()->where('is_active', 1)->where('id', '!=', $id)->exists();
    }
}
