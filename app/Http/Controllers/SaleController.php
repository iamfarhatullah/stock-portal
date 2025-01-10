<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('product')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $price = $product->price;
        $quantity = $request->quantity;
        $total = $price * $quantity;

        Sale::create([
            'product_id' => $request->product_id,
            'quantity' => $quantity,
            'price' => $price,
            'total' => $total,
        ]);

        return redirect()->route('sales.index')->with('success', 'Sale recorded successfully!');
    }
}
