<?php

namespace App\Services;

use App\Models\Product;
use Cookie;
use Illuminate\Database\Eloquent\Collection;

class LastSeeService
{
    public function setCookie(int $newProduct): void
    {
        $productsIndex = Cookie::get('laravel_optique_last_see');
        $indexArray = [];

        if ($productsIndex !== null) {
            $strArray = explode(',', $productsIndex);
            foreach ($strArray as $key => $value) {
                $indexArray[] = intval($value);
            }
        }

        if (count($indexArray) > 0) {
            if (in_array($newProduct, $indexArray)) {
                $key = array_search($newProduct, $indexArray, true);
                if ($key !== false) {
                    unset($indexArray[$key]);
                }
                array_unshift($indexArray, $newProduct);
            } else {
                array_unshift($indexArray, $newProduct);
                if (count($indexArray) > 4) {
                    array_pop($indexArray);
                }
            }

            if (count($indexArray) > 1) {
                $newValue = implode(',', $indexArray);
            } else {
                $newValue = strval($indexArray[0]);
            }
        } else {
            $newValue = strval($newProduct);
        }

        Cookie::queue(cookie('laravel_optique_last_see', $newValue, 129600));
    }

    /**
     * Undocumented function
     *
     * @return array<array<string>|string>|Collection<int, Product>
     */
    public function getLastSeeProducts(): array|Collection
    {
        $productsIndex = Cookie::get('laravel_optique_last_see');
        $indexArray = [];

        if ($productsIndex !== null) {
            $strArray = explode(' ', $productsIndex);
            foreach ($strArray as $key => $value) {
                $indexArray[] = intval($value);
            }

            $products = Product::whereIn('id', $indexArray)->with('picture')->get();

            if ($products !== null && count($products) > 0) {
                $sortedProducts = [];

                foreach ($indexArray as $key => $ind) {
                    for ($i = 0; $i < count($products); $i++) {
                        if ($ind === $products[$i]->id) {
                            $sortedProducts[] = $products[$i];
                        }
                    }
                }

                return $sortedProducts;
            } else {
                return [];
            }

        } else {
            return [];
        }
    }
}
