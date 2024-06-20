<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CatalogController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();
        return Inertia::render('Customer/Catalog', [
            'products' => $products
        ]);
    }
}
