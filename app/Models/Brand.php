<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Brand
 * 
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Brand extends Model
{
	protected $table = 'brands';

	protected $fillable = [
		'name'
	];
}
