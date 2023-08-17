<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function show(): Response
    {
        $homeDiscountProducts = Product::where('onDiscount', true)->whereNot('stock', 0)->with('picture')->inRandomOrder()->limit(4)->get();

        return Inertia::render('Home', [
            'discountProducts' => $homeDiscountProducts,
        ]);
    }
}
