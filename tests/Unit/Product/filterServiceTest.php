<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\MountAttribute;
use App\Models\OcularAttribute;
use App\Models\Product;
use App\Models\ProductPicture;
use App\Models\TelescopeAttribute;
use App\Services\FilterProductsService;

it('Filter products by brands', function () {
    $filterService = new FilterProductsService();

    $brand = Brand::factory()->create();
    $selectedBrand = Brand::factory()->create(
        [
            'name' => 'skywatcher',
        ]
    );

    $p = Product::factory(5)->create([
        'category' => 'telescope',
        'brand_id' => $brand->id,
    ]);

    $selectedProduct = Product::factory(2)->create([
        'category' => 'telescope',
        'brand_id' => $selectedBrand->id,
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

    foreach ($selectedProduct as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        TelescopeAttribute::factory()->create([
            'product_id' => $product->id,
            'mount' => 'azimutale',
        ]);
    }

    $filteredProducts = $filterService->filter('telescope', ['skywatcher'], false, []);

    expect(count($filteredProducts))->toBe(2);
    expect($filteredProducts[0]->brand_id)->toBe(2);
    expect($filteredProducts[1]->brand_id)->toBe(2);

});

it('Filter products by on stock', function () {
    $filterService = new FilterProductsService();

    $brand = Brand::factory()->create();

    $p = Product::factory(5)->create([
        'category' => 'telescope',
        'brand_id' => $brand->id,
        'stock' => 0,
    ]);

    $selectedProduct = Product::factory(2)->create([
        'category' => 'telescope',
        'brand_id' => $brand->id,
        'stock' => 2,
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

    foreach ($selectedProduct as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        TelescopeAttribute::factory()->create([
            'product_id' => $product->id,
            'mount' => 'azimutale',
        ]);
    }

    $filteredProducts = $filterService->filter('telescope', [], true, []);

    expect(count($filteredProducts))->toBe(2);
    expect($filteredProducts[0]->stock)->toBe(2);
    expect($filteredProducts[1]->stock)->toBe(2);

});

it('Filter telescope products by type', function () {
    $filterService = new FilterProductsService();

    $brand = Brand::factory()->create();

    $p = Product::factory(5)->create([
        'category' => 'telescope',
        'brand_id' => $brand->id,
    ]);

    $selectedProduct = Product::factory(2)->create([
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
            'type' => 'maksutov',
        ]);
    }

    foreach ($selectedProduct as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        TelescopeAttribute::factory()->create([
            'product_id' => $product->id,
            'mount' => 'azimutale',
            'type' => 'newton',
        ]);
    }

    $filteredProducts = $filterService->filter('telescope', [], false, [['newton']]);

    expect(count($filteredProducts))->toBe(2);
    expect($filteredProducts[0]->telescope_attribute->type)->toBe('newton');
    expect($filteredProducts[1]->telescope_attribute->type)->toBe('newton');

});

it('Filter mount products by type', function () {
    $filterService = new FilterProductsService();

    $brand = Brand::factory()->create();

    $p = Product::factory(5)->create([
        'category' => 'monture',
        'brand_id' => $brand->id,
    ]);

    $selectedProduct = Product::factory(2)->create([
        'category' => 'monture',
        'brand_id' => $brand->id,
    ]);

    foreach ($p as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        MountAttribute::factory()->create([
            'product_id' => $product->id,
            'type' => 'azimutale',
        ]);
    }

    foreach ($selectedProduct as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        MountAttribute::factory()->create([
            'product_id' => $product->id,
            'type' => 'equatoriale',
        ]);
    }

    $filteredProducts = $filterService->filter('monture', [], false, [['equatoriale'], 'all']);

    expect(count($filteredProducts))->toBe(2);
    expect($filteredProducts[0]->mount_attribute->type)->toBe('equatoriale');
    expect($filteredProducts[1]->mount_attribute->type)->toBe('equatoriale');

});

it('Filter mount products by type and withGoTo', function () {
    $filterService = new FilterProductsService();

    $brand = Brand::factory()->create();

    $p = Product::factory(5)->create([
        'category' => 'monture',
        'brand_id' => $brand->id,
    ]);

    $selectedProduct = Product::factory(2)->create([
        'category' => 'monture',
        'brand_id' => $brand->id,
    ]);

    foreach ($p as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        MountAttribute::factory()->create([
            'product_id' => $product->id,
            'type' => 'azimutale',
        ]);
    }

    foreach ($selectedProduct as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        if ($product->id === $selectedProduct[0]->id) {
            $goto = true;
        } else {
            $goto = false;
        }

        MountAttribute::factory()->create([
            'product_id' => $product->id,
            'type' => 'equatoriale',
            'goto' => $goto,
        ]);
    }

    $filteredProducts = $filterService->filter('monture', [], false, [['equatoriale'], 'with']);

    expect(count($filteredProducts))->toBe(1);
    expect($filteredProducts[0]->mount_attribute->type)->toBe('equatoriale');
    expect($filteredProducts[0]->mount_attribute->goto)->toBe(true);

});

it('Filter mount products by withGoTo', function () {
    $filterService = new FilterProductsService();

    $brand = Brand::factory()->create();

    $p = Product::factory(5)->create([
        'category' => 'monture',
        'brand_id' => $brand->id,
    ]);

    $selectedProduct = Product::factory(2)->create([
        'category' => 'monture',
        'brand_id' => $brand->id,
    ]);

    foreach ($p as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        MountAttribute::factory()->create([
            'product_id' => $product->id,
            'type' => 'azimutale',
            'goto' => true,
        ]);
    }

    foreach ($selectedProduct as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        MountAttribute::factory()->create([
            'product_id' => $product->id,
            'type' => 'equatoriale',
            'goto' => false,
        ]);
    }

    $filteredProducts = $filterService->filter('monture', [], false, [[], 'not']);

    expect(count($filteredProducts))->toBe(2);
    expect($filteredProducts[0]->mount_attribute->goto)->toBe(false);
    expect($filteredProducts[1]->mount_attribute->goto)->toBe(false);

});

it('Filter ocular products by brands', function () {
    $filterService = new FilterProductsService();

    $brand = Brand::factory()->create();
    $selectedBrand = Brand::factory()->create([
        'name' => 'orion',
    ]);

    $p = Product::factory(5)->create([
        'category' => 'oculaire',
        'brand_id' => $brand->id,
    ]);

    $selectedProduct = Product::factory(2)->create([
        'category' => 'oculaire',
        'brand_id' => $selectedBrand->id,
    ]);

    foreach ($p as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        OcularAttribute::factory()->create([
            'product_id' => $product->id,
        ]);
    }

    foreach ($selectedProduct as $key => $product) {
        ProductPicture::factory()->create([
            'product_id' => $product->id,
        ]);

        OcularAttribute::factory()->create([
            'product_id' => $product->id,
        ]);
    }

    $filteredProducts = $filterService->filter('oculaire', ['orion'], false, ['default']);

    expect(count($filteredProducts))->toBe(2);
    expect($filteredProducts[0]->brand_id)->toBe($selectedBrand->id);
    expect($filteredProducts[1]->brand_id)->toBe($selectedBrand->id);

});
