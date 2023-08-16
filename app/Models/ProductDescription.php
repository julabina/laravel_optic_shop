<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 */
class ProductDescription extends Model
{
    use HasFactory;

    protected $table = 'product_descriptions';

    protected $casts = [
        'product_id' => 'int',
    ];

    protected $fillable = [
        'product_id',
        'description',
        'picturePath',
    ];
}
