<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static orderBy(string $string, string $string1)
 * @method static create(array $array)
 * @method static where(string $string, $order_id)
 */
class Order extends Model
{
	use SoftDeletes;

	public $timestamps = true;
	protected $guarded = [];
	protected $dates = ['deleted_at'];

	public function orderItems(): HasMany
	{
		return $this->hasMany(OrderItem::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
