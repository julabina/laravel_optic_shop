<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Cookie;

class CartController extends Controller
{
    public function store(int $id, int $count)
    {
        $product = Product::find($id);

        if ($product !== null && $product->stock > 0) {
            $cart = Cookie::get('laravel_optique_cart');
            $cartArray = [];
            $exist = false;

            if ($cart !== null) {
                $cartArray = explode(' ', $cart);
                $newCartArray = [];
                
                foreach ($cartArray as $key => $value) {
                    $item = explode(',', $value);
                    
                    if (intval($item[0]) === $id) {
                        $exist = true;
                        $item[1] = strval($count);

                        $value = implode(',', $item);
                    }

                    $newCartArray[] = $value;
                }

                if ($exist === true) {
                    $cartArray = $newCartArray;
                }
            }

            if ($exist === false) {
                
                $value = $id . ',' . $count;
                
                $cartArray[] = $value;
            }

            $newValue = implode(' ', $cartArray);
            
            Cookie::queue(cookie('laravel_optique_cart', $newValue, 129600));
        }

        return back();
    }
}
