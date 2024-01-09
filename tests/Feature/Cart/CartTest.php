<?php

namespace Test\Feature\Cart;

use App\Models\Product;

it('Store an article when there are no cookie', function () {
    $product = Product::factory()->create([
        'stock' => 7,
    ]);
    $count = 3;

    $this->post(route('cart.store', ['id' => $product->id, 'count' => $count]));

    expect(session('newAddToCart'))->toBe([$product->id, $count]);
});

/* it('delete articles from cart page', function () {
    
}) */
