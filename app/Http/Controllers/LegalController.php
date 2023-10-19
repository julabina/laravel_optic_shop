<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class LegalController extends Controller
{
    public function show(): Response
    {
        return Inertia::render('Legals/Legals');
    }

    public function cgu(): Response
    {
        return Inertia::render('Legals/Cgu');
    }
}
