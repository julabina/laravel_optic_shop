<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\FilterProductsService;
use App\Services\LastSeeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function list(string $cat, Request $request): Response
    {
        $filterService = new FilterProductsService();
        $lastSeeService = new LastSeeService();

        $filterBrands = [];
        $filterOther = [];
        $newAddToCart = [];
        $onStock = false;

        if ($request->session()->has('filterBrand')) {
            $filterBrands = $request->session()->pull('filterBrand');
        }
        if ($request->session()->has('onStock')) {
            $onStock = $request->session()->pull('onStock');
        }
        if ($request->session()->has('filterOther')) {
            $filterOther = $request->session()->pull('filterOther');
        }
        if ($request->session()->has('newAddToCart')) {
            $newAdd = $request->session()->pull('newAddToCart');
            $productAdded = Product::find($newAdd[0]);

            if ($productAdded !== null && $productAdded->stock > 0) {
                $newAddToCart = [
                    $productAdded,
                    $newAdd[1],
                ];
            }
        }

        $products = $filterService->filter($cat, $filterBrands, $onStock, $filterOther);
        $lastSee = $lastSeeService->getLastSeeProducts();

        if ($cat === 'monture' && isset($filterOther[0]) === false) {
            $filterOther[0] = [];
        }

        return Inertia::render('ProductList', [
            'category' => $cat,
            'products' => $products,
            'filterBrands' => $filterBrands,
            'filterOnStock' => $onStock,
            'filterOther' => $filterOther,
            'lastSee' => $lastSee,
            'newAddToCart' => $newAddToCart,
        ]);
    }

    public function show(string $cat, int $id, Request $request): Response
    {
        $lastSeeService = new LastSeeService();

        if ($cat === 'monture') {
            $attribute = 'mount_attribute';
        } elseif ($cat === 'oculaire') {
            $attribute = 'ocular_attribute';
        } else {
            $attribute = $cat.'_attribute';
        }

        $product = Product::where('id', $id)->with('picture', $attribute, 'descriptions', 'brand', 'comments.user')->first();
        $lastSeeService->setCookie($product->id);

        $commentTab = false;

        if ($request->session()->has('commentTab')) {
            $commentTab = $request->session()->pull('commentTab');
        }

        return Inertia::render('Product', [
            'product' => $product,
            'category' => $cat,
            'commentTab' => $commentTab,
        ]);
    }

    public function discountList(Request $request): Response
    {
        $lastSeeService = new LastSeeService();

        $newAddToCart = [];

        if ($request->session()->has('newAddToCart')) {
            $newAdd = $request->session()->pull('newAddToCart');
            $productAdded = Product::find($newAdd[0]);

            if ($productAdded !== null && $productAdded->stock > 0) {
                $newAddToCart = [
                    $productAdded,
                    $newAdd[1],
                ];
            }
        }

        $discountProducts = Product::where('onDiscount', true)->with('picture')->get();

        $lastSee = $lastSeeService->getLastSeeProducts();

        return Inertia::render('DiscountList', [
            'products' => $discountProducts,
            'lastSee' => $lastSee,
            'newAddToCart' => $newAddToCart,
        ]);
    }

    public function filter(string $cat, Request $request): RedirectResponse
    {
        if ($request->filterBrand) {
            $request->session()->put('filterBrand', $request->filterBrand);
        }

        if ($request->onStock) {
            $request->session()->put('onStock', boolval($request->onStock));
        }

        if ($request->other) {
            $request->session()->put('filterOther', $request->other);
        }

        return redirect()->route('product.list', ['cat' => $cat]);
    }
}
