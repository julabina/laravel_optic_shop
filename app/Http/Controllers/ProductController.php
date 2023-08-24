<?php

namespace App\Http\Controllers;

use App\Services\FilterProductsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function list(string $cat, Request $request): Response
    {
        $filterService = new FilterProductsService();
        
        $filterBrands = [];
        $onStock = false;
        
        if ($request->session()->has('filterBrand')) {
            $filterBrands = $request->session()->pull('filterBrand');
        }
        if ($request->session()->has('onStock')) {
            $onStock = $request->session()->pull('onStock');
        }
        
        $products = $filterService->filter($cat, $filterBrands, $onStock);

        return Inertia::render('ProductList', [
            'category' => $cat,
            'products' => $products,
            'filterBrands' => $filterBrands,
            'filterOnStock' => $onStock,
        ]);
    }

    public function show(string $cat, int $id): Response
    {
        return Inertia::render('Product');
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

        return redirect()->route('product.list', ['cat' => $cat]);
    }
}
