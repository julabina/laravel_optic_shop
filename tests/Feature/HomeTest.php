<?php

namespace Tests\Feature;

it('Display home page', function () {
    $response = $this->get(route('home'));

    $response
        ->assertOk();
});
