<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MountAttribute
 * 
 * @property int $id
 * @property int $product_id
 * @property string $type
 * @property int $capacity
 * @property bool $goto
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class MountAttribute extends Model
{
	protected $table = 'mount_attributes';

	protected $casts = [
		'product_id' => 'int',
		'capacity' => 'int',
		'goto' => 'bool'
	];

	protected $fillable = [
		'product_id',
		'type',
		'capacity',
		'goto'
	];
}
