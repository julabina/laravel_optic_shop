<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property float $price
 * @property int $stock
 * @property bool $onDiscount
 * @property int $discountValue
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $casts = [
        'brand_id' => 'int',
        'price' => 'float',
        'stock' => 'int',
        'onDiscount' => 'bool',
        'discountValue' => 'int',
    ];

    protected $fillable = [
        'category',
        'name',
        'price',
        'stock',
        'onDiscount',
        'discountValue',
    ];

    /**
     * @return HasMany<ProductPicture>
     */
    public function picture(): HasMany
    {
        return $this->hasMany(ProductPicture::class);
    }
}
