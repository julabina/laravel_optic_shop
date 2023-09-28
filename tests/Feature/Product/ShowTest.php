<?php

namespace Test\Feature;

use App\Models\Brand;
use App\Models\MountAttribute;
use App\Models\OcularAttribute;
use App\Models\Product;
use App\Models\ProductPicture;
use App\Models\TelescopeAttribute;
use Inertia\Testing\AssertableInertia;

it('Display telescope product page', function () {
    $brand = Brand::factory()->create();

    $product = Product::factory()->create([
        'category' => 'telescope',
        'brand_id' => $brand->id,
    ]);

    ProductPicture::factory()->create([
        'product_id' => $product->id,
    ]);

    TelescopeAttribute::factory()->create([
        'product_id' => $product->id,
        'type' => 'newton',
    ]);

    $p = Product::where('id', $product->id)->with('picture', 'telescope_attribute', 'descriptions', 'brand', 'comments.user')->first();
    $response = $this->get(route('product.show', ['cat' => 'telescope', 'id' => $product->id]));

    $response
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Product')
            ->where('category', 'telescope')
            ->where('product', $p)
            ->where('commentTab', false)
        );
});

it('Display mount product page', function () {
    $brand = Brand::factory()->create();

    $product = Product::factory()->create([
        'category' => 'monture',
        'brand_id' => $brand->id,
    ]);

    ProductPicture::factory()->create([
        'product_id' => $product->id,
    ]);

    MountAttribute::factory()->create([
        'product_id' => $product->id,
        'type' => 'azimutale',
    ]);

    $p = Product::where('id', $product->id)->with('picture', 'mount_attribute', 'descriptions', 'brand', 'comments.user')->first();
    $response = $this->get(route('product.show', ['cat' => 'monture', 'id' => $product->id]));

    $response
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Product')
            ->where('category', 'monture')
            ->where('product', $p)
            ->where('commentTab', false)
        );
});

it('Display ocular product page', function () {
    $brand = Brand::factory()->create();

    $product = Product::factory()->create([
        'category' => 'oculaire',
        'brand_id' => $brand->id,
    ]);

    ProductPicture::factory()->create([
        'product_id' => $product->id,
    ]);

    OcularAttribute::factory()->create([
        'product_id' => $product->id,
    ]);

    $p = Product::where('id', $product->id)->with('picture', 'ocular_attribute', 'descriptions', 'brand', 'comments.user')->first();
    $response = $this->get(route('product.show', ['cat' => 'oculaire', 'id' => $product->id]));

    $response
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Product')
            ->where('category', 'oculaire')
            ->where('product', $p)
            ->where('commentTab', false)
        );
});
