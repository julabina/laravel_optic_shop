<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * @return HasMany<ProductDescription>
     */
    public function descriptions(): HasMany
    {
        return $this->hasMany(ProductDescription::class);
    }

    /**
     * @return HasOne<TelescopeAttribute>
     */
    public function telescope_attribute(): HasOne
    {
        return $this->hasOne(TelescopeAttribute::class);
    }

    /**
     * @return HasOne<MountAttribute>
     */
    public function mount_attribute(): HasOne
    {
        return $this->hasOne(MountAttribute::class);
    }

    /**
     * @return HasOne<OcularAttribute>
     */
    public function ocular_attribute(): HasOne
    {
        return $this->hasOne(OcularAttribute::class);
    }

    /**
     * @return BelongsTo<Brand, Product>
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
