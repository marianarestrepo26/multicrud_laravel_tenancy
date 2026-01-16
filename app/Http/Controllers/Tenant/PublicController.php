<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $tenant = tenant();
        return view('tenant.welcome', compact('products', 'tenant'));
    }
}
