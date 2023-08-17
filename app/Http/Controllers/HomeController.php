<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;

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
