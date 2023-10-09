<?php

namespace Tests\Unit;

use App\Services\LastSeeService;

it('get last see products when there are no cookie', function () {
    $lastSeeService = new LastSeeService();

    $lastSeeProducts = $lastSeeService->getLastSeeProducts();

    expect(count($lastSeeProducts))->toBe(0);
});
