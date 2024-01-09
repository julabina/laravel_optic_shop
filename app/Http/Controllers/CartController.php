<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Cookie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    public function store(int $id, int $count, Request $request): RedirectResponse
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

                if ($product->onDiscount === true) {
                    $priceVal = $product->price - (($product->price / 100) * $product->discountValue);
                } else {
                    $priceVal = $product->price;
                }

                $value = $id.','.$count.','.$priceVal;

                $cartArray[] = $value;
            }

            $newValue = implode(' ', $cartArray);

            Cookie::queue(cookie('laravel_optique_cart', $newValue, 129600, null, null, false, false));

            $request->session()->put('newAddToCart', [$id, $count]);
        }

        return back();
    }

    public function show(): Response
    {
        $cart = Cookie::get('laravel_optique_cart');
        $finalArr = [];

        if ($cart !== null) {
            $cartArray = explode(' ', $cart);
            $cartItemIds = [];
            $cartFinalArr = [];

            foreach ($cartArray as $key => $arr) {
                $valArr = explode(',', $arr);
                $cartFinalArr[] = [
                    intval($valArr[0]),
                    intval($valArr[1]),
                ];

                $cartItemIds[] = [
                    intval($valArr[0]),
                ];
            }

            sort($cartFinalArr);
            $cartFinalArr = array_values($cartFinalArr);

            $cartProducts = Product::whereIn('id', $cartItemIds)->with('picture')->get();

            for ($i = 0; $i < count($cartProducts); $i++) {
                $productArr = [$cartProducts[$i]];

                if ($cartFinalArr[$i][0] === $cartProducts[$i]->id) {
                    $productArr[] = $cartFinalArr[$i][1];
                } else {
                    foreach ($cartFinalArr as $key => $value) {
                        if ($value[0] === $productArr[$i]->id) {
                            $productArr[] = $value[1];
                        }
                    }
                }

                $finalArr[] = $productArr;
            }
        }

        return Inertia::render('Cart', [
            'articles' => $finalArr,
        ]);
    }
}
