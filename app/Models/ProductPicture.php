<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductPicture
 * 
 * @property int $id
 * @property int $product_id
 * @property string $path
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class ProductPicture extends Model
{
	protected $table = 'product_pictures';

	protected $casts = [
		'product_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'path'
	];
}
