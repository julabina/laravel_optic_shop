<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Comment
 * 
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Comment extends Model
{
	use HasFactory;

	protected $table = 'comments';

	protected $casts = [
		'product_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'user_id',
		'content'
	];

	/**
     * @return BelongsTo<Product, Comment>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

	/**
     * @return HasOne<User>
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
