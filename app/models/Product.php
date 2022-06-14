<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = ['name', 'price', 'description', 'category_id', 'image_path', 'quantity'];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFooterProducts($query)
    {
        $query->orderBy('id','DESC')->limit(4);
    }
}
