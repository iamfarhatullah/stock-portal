<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\StocksRecord;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StocksRecordController extends Controller
{
    // Show the stock records for a specific product
    public function productstock(Product $product)
    {
        $stockRecords = $product->stockRecords; // Eager loading stock records
        return view('stocks.product-stock', compact('product', 'stockRecords'));
    }

    public function index(Request $request)
    {
        $products = Product::all(); // Fetch all products
        // Default to the current month and year if no month is provided
        $month = $request->has('month') && $request->month
            ? Carbon::createFromFormat('Y-m', $request->month)
            : Carbon::now();

        // Query stock records for the specified month and year
        $stockRecords = StocksRecord::with('product')
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->get();

        // Pass the selected month to the view for form pre-filling
        $selectedMonth = $month->format('Y-m');

        return view('stocks.index', compact('stockRecords', 'selectedMonth', 'products'));
    }

    // Show the form to add a new stock record (incoming or outgoing)
    public function create(Product $product)
    {
        return view('stocks.create', compact('product'));
    }

    // Store a new stock movement (incoming or outgoing)
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'type' => 'required|in:incoming,outgoing',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Check if outgoing quantity exceeds the available quantity
        if ($request->type == 'outgoing' && $request->quantity > $product->quantity) {
            return redirect()->back()->withErrors([
                'quantity' => 'Outgoing quantity exceeds available stock. Current stock: ' . $product->quantity,
            ])->withInput();
        }
        
        // Update product quantity based on stock movement type
        if ($request->type == 'incoming') {
            $product->quantity += $request->quantity;
        } elseif ($request->type == 'outgoing') {
            $product->quantity -= $request->quantity;
        }

        // Save the product's new quantity
        $product->save();

        // Create the stock record
        StocksRecord::create([
            'product_id' => $product->id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        return redirect()->route('stocks.product-stock', $product->id)->with('message', 'Stock movement recorded successfully!');
    }
}
