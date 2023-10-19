<?php

namespace Tests\Feature;

it('Display legals page', function () {
    $response = $this->get(route('legals.show'));

    $response
        ->assertOk();
});

it('Display cgu page', function () {
    $response = $this->get(route('legals.cgu'));

    $response
        ->assertOk();
});
