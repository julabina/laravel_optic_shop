<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Inertia\Response;

class ProductController extends Controller
{
    public function list(string $cat): Response
    {
        $products = Product::where('category', $cat)->with('picture')->get();

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
