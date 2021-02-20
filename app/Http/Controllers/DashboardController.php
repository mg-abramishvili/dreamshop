<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('backend.dashboard.index', compact('products'));
    }
}
