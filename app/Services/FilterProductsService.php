<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class FilterProductsService
{
    /**
     * Undocumented function
     *
     * @param  array<int>  $brandArr
     * @return Collection<int, Product>
     */
    public function filter(string $cat, array $brandArr, bool $onStock): Collection
    {
        if ($cat === 'monture') {
            $attribute = 'mount_attribute';
        } elseif ($cat === 'oculaire') {
            $attribute = 'ocular_attribute';
        } else {
            $attribute = $cat.'_attribute';
        }

        $brand = [];
        $onStock = $onStock;

        if (count($brandArr) > 0) {
            $brand = $brandArr;
        }

        $products = Product::where('category', $cat)->when($brand, function (Builder $query, array $brand) {
            $query->whereIn('brand_id', $brand);
        })->when($onStock, function (Builder $query, bool $onStock) {
            $query->where('stock', '>', 0);
        })->with('picture', $attribute)->get();

        return $products;
    }
}
