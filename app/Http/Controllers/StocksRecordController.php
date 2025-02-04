<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\StocksRecord;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StocksRecordController extends Controller
{
    public function main_index(Request $request)
    {
        $products = Product::all(); 
        $stockRecords = StocksRecord::all();
        return view('stocks.index', compact('stockRecords', 'products'));
    }

    public function index()
    {
        $stockRecords = StocksRecord::with('product')->get();
        if ($stockRecords->isEmpty()) {
            return redirect()->route('stocks.stock_records.create');
        }
        return view('stocks.stock_records.index', compact('stockRecords'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stocks.stock_records.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:incoming,outgoing',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($validated['type'] == 'outgoing' && $product->quantity < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'The outgoing quantity cannot exceed the available stock.']);
        }
        
        if ($validated['type'] == 'incoming') {
            $product->quantity += $validated['quantity'];
        } else {   
            $product->quantity -= $validated['quantity'];
        }

        $product->save();

        $validated['price'] = $product->price;

        StocksRecord::create($validated);

        return redirect()->route('stocks.stock_records.index')->with('success', 'Stock record created successfully.');
    }

    public function edit($id)
    {
        $stockRecord = StocksRecord::findOrFail($id);
        $products = Product::all();
        return view('stocks.stock_records.edit', compact('stockRecord', 'products'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:incoming,outgoing',
            'quantity' => 'required|integer|min:1',
        ]);

        $stockRecord = StocksRecord::findOrFail($id);
        $product = Product::findOrFail($validated['product_id']);

        $quantityDifference = $validated['quantity'] - $stockRecord->quantity;

        if ($validated['type'] == 'outgoing' && $product->quantity < $quantityDifference) {
            return back()->withErrors(['quantity' => 'The outgoing quantity cannot exceed the available stock.']);
        }

        if ($validated['type'] == 'incoming') {
            $product->quantity += $quantityDifference;
        } else {
            $product->quantity -= $quantityDifference;
        }

        $product->save();

        $validated['price'] = $product->price;
        
        $stockRecord->update($validated);

        return redirect()->route('stocks.stock_records.index')->with('success', 'Stock record updated successfully.');
    }

    public function destroy($id)
    {
        $stockRecord = StocksRecord::findOrFail($id);
        $product = $stockRecord->product; 
        
        if ($stockRecord->type == 'incoming') {
            $product->quantity -= $stockRecord->quantity;
        } else {
            $product->quantity += $stockRecord->quantity;
        }

        $product->save();
    
        $stockRecord->delete();
        
        return redirect()->route('stocks.stock_records.index')->with('success', 'Stock record deleted successfully.');
    }
}
