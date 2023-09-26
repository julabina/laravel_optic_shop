<?php

namespace Test\Unit;

it('Test filter function to productController', function () {
    $response = $this->post(route('product.filter', [
        'cat' => 'telescope',
        'filterBrand' => ['skywatcher'],
        'onStock' => true,
        'other' => ['newton'],
    ]));

    $response
        ->assertRedirectToRoute('product.list', ['cat' => 'telescope']);

    expect(session('filterBrand'))->toBe(['skywatcher']);
    expect(session('onStock'))->toBe(true);
    expect(session('filterOther'))->toBe(['newton']);

});
