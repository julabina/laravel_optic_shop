<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class FilterProductsService
{
    /**
     * Undocumented function
     *
     * @param  array<int>  $brandArr
     * @param  array<array<string>|string>  $other
     * @return array<array<string>|string>|Collection<int, Product>
     */
    public function filter(string $cat, array $brandArr, bool $onStock, array $other): array|Collection
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
            $brand = Brand::select('id')->whereIn('name', $brandArr)->get()->toArray();
        }

        $products = Product::where('category', $cat)->when($brand, function (Builder $query, array $brand) {
            $query->whereIn('brand_id', $brand);
        })->when($onStock, function (Builder $query, bool $onStock) {
            $query->where('stock', '>', 0);
        })->with('picture', $attribute)->get();

        $filteredProducts = [];

        if ($cat === 'telescope' && (isset($other[0]) && count($other[0]) > 0)) {
            foreach ($products as $key => $product) {
                if (in_array($product->telescope_attribute->type, $other[0])) {
                    $filteredProducts[] = $product;
                }
            }
        } elseif ($cat === 'monture' && isset($other[1])) {
            if (isset($other[0]) === false) {
                $other[0] = [];
            }

            if (count($other[0]) > 0 || $other[1] !== 'all') {
                foreach ($products as $key => $product) {
                    if (count($other[0]) > 0) {
                        if (in_array($product->mount_attribute->type, $other[0])) {
                            if ($other[1] === 'with' && $product->mount_attribute->goto === true) {
                                $filteredProducts[] = $product;
                            } elseif ($other[1] === 'not' && $product->mount_attribute->goto === false) {
                                $filteredProducts[] = $product;
                            } if ($other[1] === 'all') {
                                $filteredProducts[] = $product;
                            }
                        }
                    } else {
                        if ($other[1] === 'with' && $product->mount_attribute->goto === true) {
                            $filteredProducts[] = $product;
                        } elseif ($other[1] === 'not' && $product->mount_attribute->goto === false) {
                            $filteredProducts[] = $product;
                        }
                    }
                }
            } else {
                $filteredProducts = $products;
            }
        } else {
            $filteredProducts = $products;
        }

        return $filteredProducts;
    }
}
