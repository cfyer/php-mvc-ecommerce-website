<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static orderBy(string $string, string $string1)
 * @method static create(array $array)
 * @method static where(string $string, $id)
 */
class Slider extends Model
{
    use SoftDeletes;
    public $table = 'slides';
    public $timestamps = true;
    protected $fillable = ['image_path', 'link', 'is_active'];
    protected $dates = ['deleted_at'];

    public static function countActiveSlides($id): bool
    {
        return static::query()->where('is_active', 1)->where('id', '!=', $id)->exists();
    }
}
