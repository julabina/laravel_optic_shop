<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function list(String $cat)
    {
        return Inertia::render('ProductList');
    }
    
    public function show(String $cat, Int $id)
    {
        return Inertia::render('Product');
    }
    
    public function discountList()
    {
        return Inertia::render('discountList');
    }
}
