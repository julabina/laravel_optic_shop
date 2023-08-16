<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TelescopeAttribute
 *
 * @property int $id
 * @property int $product_id
 * @property string $type
 * @property int $diameter
 * @property int $focalLength
 * @property string|null $mount
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class TelescopeAttribute extends Model
{
    use HasFactory;

    protected $table = 'telescope_attributes';

    protected $casts = [
        'product_id' => 'int',
        'diameter' => 'int',
        'focalLength' => 'int',
    ];

    protected $fillable = [
        'product_id',
        'type',
        'diameter',
        'focalLength',
        'mount',
    ];
}
