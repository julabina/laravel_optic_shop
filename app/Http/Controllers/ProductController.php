<?php

namespace App\Http\Controllers;

use App\Services\FilterProductsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;

class ProductController extends Controller
{
    public function list(string $cat, Request $request): Response
    {
        $filterService = new FilterProductsService();

        $filterBrands = [];
        $filterOther = [];
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

        $products = $filterService->filter($cat, $filterBrands, $onStock, $filterOther);

        if ($cat === 'monture' && isset($filterOther[0]) === false) {
            $filterOther[0] = [];
        }

        return Inertia::render('ProductList', [
            'category' => $cat,
            'products' => $products,
            'filterBrands' => $filterBrands,
            'filterOnStock' => $onStock,
            'filterOther' => $filterOther,
        ]);
    }

    public function show(string $cat, int $id): Response
    {
        if ($cat === 'monture') {
            $attribute = 'mount_attribute';
        } elseif ($cat === 'oculaire') {
            $attribute = 'ocular_attribute';
        } else {
            $attribute = $cat.'_attribute';
        }

        $product = Product::where('id', $id)->with('picture', $attribute, 'descriptions', 'brand')->first();

        return Inertia::render('Product', [
            'product' => $product,
            'category' => $cat,
        ]);
    }

    public function discountList(): Response
    {
        return Inertia::render('discountList');
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
