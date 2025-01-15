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

    public function index()
    {
        $stockRecords = StocksRecord::with('product')->get();
        if ($stockRecords->isEmpty()) {
            return redirect()->route('stocks.stock_records.create');
        }
        return view('stocks.stock_records.index', compact('stockRecords'));
    }

    /**
     * Show the form for creating a new stock record.
     */
    public function create()
    {
        $products = Product::all();
        return view('stocks.stock_records.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validate the input (price is no longer required in the form)
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:incoming,outgoing',
            'quantity' => 'required|integer|min:1',
        ]);

        // Get the product associated with the stock record
        $product = Product::findOrFail($validated['product_id']);

        // If the type is outgoing, check if the quantity is greater than the current stock
        if ($validated['type'] == 'outgoing' && $product->quantity < $validated['quantity']) {
            // If outgoing stock is greater than the available stock, return with an error message
            return back()->withErrors(['quantity' => 'The outgoing quantity cannot exceed the available stock.']);
        }

        // If the stock record type is incoming, increase the product quantity
        if ($validated['type'] == 'incoming') {
            $product->quantity += $validated['quantity'];
        } else {
            // If the stock record type is outgoing, decrease the product quantity
            $product->quantity -= $validated['quantity'];
        }

        // Save the updated product quantity
        $product->save();

        // Extract the price from the product table and add it to the validated data
        $validated['price'] = $product->price;

        // Create the stock record with the price taken from the product table
        StocksRecord::create($validated);

        // Redirect to the stock records index with a success message
        return redirect()->route('stocks.stock_records.index')->with('success', 'Stock record created successfully.');
    }



    /**
     * Show the form for editing a specific stock record.
     */
    public function edit($id)
    {
        $stockRecord = StocksRecord::findOrFail($id);
        $products = Product::all();
        return view('stocks.stock_records.edit', compact('stockRecord', 'products'));
    }

    /**
     * Update a specific stock record in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the input (price is no longer required in the form)
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:incoming,outgoing',
            'quantity' => 'required|integer|min:1',
        ]);

        // Get the existing stock record to update
        $stockRecord = StocksRecord::findOrFail($id);
        $product = Product::findOrFail($validated['product_id']);

        // Calculate the difference in quantity for both incoming and outgoing
        $quantityDifference = $validated['quantity'] - $stockRecord->quantity;

        // If the type is outgoing, check if the quantity is greater than the current stock
        if ($validated['type'] == 'outgoing' && $product->quantity < $quantityDifference) {
            // If outgoing stock is greater than the available stock, return with an error message
            return back()->withErrors(['quantity' => 'The outgoing quantity cannot exceed the available stock.']);
        }

        // Update the product quantity based on the stock record type
        if ($validated['type'] == 'incoming') {
            // For incoming, increase the product quantity
            $product->quantity += $quantityDifference;
        } else {
            // For outgoing, decrease the product quantity
            $product->quantity -= $quantityDifference;
        }

        // Save the updated product quantity
        $product->save();

        // Extract the price from the product table and add it to the validated data
        $validated['price'] = $product->price;

        // Update the stock record with the new validated data
        $stockRecord->update($validated);

        // Redirect to the stock records index with a success message
        return redirect()->route('stocks.stock_records.index')->with('success', 'Stock record updated successfully.');
    }


    /**
     * Remove a specific stock record from storage.
     */
    public function destroy($id)
    {
        // Find the stock record to delete
        $stockRecord = StocksRecord::findOrFail($id);
        $product = $stockRecord->product;  // Get the associated product
    
        // Adjust the product quantity based on the type of stock record
        if ($stockRecord->type == 'incoming') {
            // If the stock record type is incoming, decrease the product quantity
            $product->quantity -= $stockRecord->quantity;
        } else {
            // If the stock record type is outgoing, increase the product quantity
            $product->quantity += $stockRecord->quantity;
        }
    
        // Save the updated product quantity
        $product->save();
    
        // Delete the stock record
        $stockRecord->delete();
    
        // Redirect to the stock records index with a success message
        return redirect()->route('stocks.stock_records.index')->with('success', 'Stock record deleted successfully.');
    }
    
}
