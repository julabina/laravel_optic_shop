<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\ProductPicture;
use Inertia\Testing\AssertableInertia;

it('Display promotion list page', function () {
    $p = Product::factory(5)->create();

    $pDiscount = Product::factory(3)->create([
        'onDiscount' => true,
        'discountValue' => 10,
    ]);

    foreach ($p as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);
    }

    foreach ($pDiscount as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);
    }

    $discountProducts = Product::where('onDiscount', true)->with('picture')->get();

    $response = $this->get(route('product.discountList'));

    $response
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('DiscountList')
            ->where('products', $discountProducts)
        );
});
