<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductDescription
 * 
 * @property int $id
 * @property int $product_id
 * @property string|null $description
 * @property string|null $picturePath
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class ProductDescription extends Model
{
	protected $table = 'product_descriptions';

	protected $casts = [
		'product_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'description',
		'picturePath'
	];
}
