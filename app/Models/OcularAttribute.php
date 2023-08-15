<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class OcularAttribute
 * 
 * @property int $id
 * @property int $product_id
 * @property string $model
 * @property int $focalLength
 * @property int $fov
 * @property int $eyeRelief
 * @property int $size
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class OcularAttribute extends Model
{
	use HasFactory;
	
	protected $table = 'ocular_attributes';

	protected $casts = [
		'product_id' => 'int',
		'focalLength' => 'int',
		'fov' => 'int',
		'eyeRelief' => 'int',
		'size' => 'int'
	];

	protected $fillable = [
		'product_id',
		'brand_id',
		'model',
		'focalLength',
		'fov',
		'eyeRelief',
		'size'
	];
}
