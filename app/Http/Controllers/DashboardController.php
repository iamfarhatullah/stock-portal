<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $products = Product::all();
        $totalProducts = Product::count();
        $zeroQuantityProducts = Product::where('quantity', 0)->count();
        $lowQuantityProducts = Product::where('quantity', '<', 20)->count();


        return view('dashboard', compact('products', 'totalProducts', 'zeroQuantityProducts', 'lowQuantityProducts'));
    }
}
