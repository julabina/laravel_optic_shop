<?php

namespace App\Http\Controllers;

use App\Services\FilterProductsService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function list(string $cat, Request $request): Response
    {
        $filterService = new FilterProductsService();

        $products = $filterService->filter($cat, [], false);

        return Inertia::render('ProductList', [
            'category' => $cat,
            'products' => $products,
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
}
