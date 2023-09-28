<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\MountAttribute;
use App\Models\OcularAttribute;
use App\Models\Product;
use App\Models\ProductPicture;
use App\Models\TelescopeAttribute;
use Inertia\Testing\AssertableInertia;

it('Display telescope list page', function () {
    $brand = Brand::factory()->create();

    $p = Product::factory(5)->create([
        'category' => 'telescope',
        'brand_id' => $brand->id,
    ]);

    foreach ($p as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        TelescopeAttribute::factory()->create([
            'product_id' => $product->id,
            'mount' => 'azimutale',
        ]);
    }

    $products = Product::where('category', 'telescope')->with('picture', 'telescope_attribute')->get();
    $response = $this->get(route('product.list', ['cat' => 'telescope']));

    $response
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('ProductList')
            ->where('category', 'telescope')
            ->where('products', $products)
            ->where('filterBrands', [])
            ->where('filterOnStock', false)
            ->where('filterOther', [])
        );
});

it('Display mount list page', function () {
    $brand = Brand::factory()->create();

    $p = Product::factory(5)->create([
        'category' => 'monture',
        'brand_id' => $brand->id,
    ]);

    foreach ($p as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        MountAttribute::factory()->create([
            'product_id' => $product->id,
        ]);
    }

    $products = Product::where('category', 'monture')->with('picture', 'mount_attribute')->get();
    $response = $this->get(route('product.list', ['cat' => 'monture']));

    $response
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('ProductList')
            ->where('category', 'monture')
            ->where('products', $products)
            ->where('filterBrands', [])
            ->where('filterOnStock', false)
            ->where('filterOther', [[]])
        );
});

it('Display ocular list page', function () {
    $brand = Brand::factory()->create();

    $p = Product::factory(5)->create([
        'category' => 'oculaire',
        'brand_id' => $brand->id,
    ]);

    foreach ($p as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        OcularAttribute::factory()->create([
            'product_id' => $product->id,
        ]);
    }

    $products = Product::where('category', 'oculaire')->with('picture', 'ocular_attribute')->get();
    $response = $this->get(route('product.list', ['cat' => 'oculaire']));

    $response
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('ProductList')
            ->where('category', 'oculaire')
            ->where('products', $products)
            ->where('filterBrands', [])
            ->where('filterOnStock', false)
            ->where('filterOther', [])
        );
});
