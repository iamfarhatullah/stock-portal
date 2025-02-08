<?php

namespace App\Http\Controllers;

use App\Models\WarehouseDetail;
use App\Models\Warehouse;
use App\Models\StocksRecord;
use App\Models\Product;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {   
        $products = Product::all();
        $warehouses = Warehouse::all();
        return view('warehouse.index', compact('warehouses', 'products'));
    }

    public function create()
    {
        $products = Product::all(); // Fetch all products
        return view('warehouse.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'cost' => 'required|numeric',
            // 'units' => 'required|integer|min:1',    
            'date' => 'required|date',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id', 
        ]);

        foreach ($request->product_ids as $productId) {
            $request->validate([
                'quantities.' . $productId => 'required|integer|min:1',
            ]);
        }

        $units_ordered = 0;
        foreach($request->quantities as $quantity){
            $units_ordered += $quantity;
        }

        // Store warehouse record
        $warehouse = Warehouse::create([
            'description' => $request->description,
            'cost' => $request->cost,
            'units' => $units_ordered,
            'date' => $request->date,
        ]);

        // Store warehouse details
        foreach ($request->product_ids as $productId) {
            WarehouseDetail::create([
                'warehouse_id' => $warehouse->id,
                'product_id' => $productId,
                'quantity' => $request->quantities[$productId],
            ]);
        }

        return redirect()->route('warehouse.index')->with('message', 'Warehouse record added successfully!');
    }



    public function edit($id)
    {
        $warehouse = Warehouse::with('details')->findOrFail($id);
        $products = Product::all();

        return view('warehouse.edit', compact('warehouse', 'products'));
    }

    public function update(Request $request, $id)
    {
        // Filter only selected products (those that are checked)
        $selectedProducts = array_filter($request->input('products', []), function ($product) {
            return isset($product['id']); // Keep only selected checkboxes
        });

        // Validate only selected products
        $validatedData = $request->validate([
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
            // 'units' => 'required|integer|min:1',
            'date' => 'required|date',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        foreach ($request->product_ids as $productId) {
            $request->validate([
                'quantities.' . $productId => 'required|integer|min:1',
            ]);
        }
        $units_ordered = 0;
        foreach($request->quantities as $quantity){
            $units_ordered += $quantity;
        }
        // Update warehouse details
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->update([
            'description' => $validatedData['description'],
            'cost' => $validatedData['cost'],
            'units' => $units_ordered,
            'date' => $validatedData['date'],
        ]);

        // Remove previous warehouse details
        WarehouseDetail::where('warehouse_id', $warehouse->id)->delete();

        // Store only selected products
        foreach ($request->product_ids as $productId) {
            WarehouseDetail::create([
                'warehouse_id' => $warehouse->id,
                'product_id' => $productId,
                'quantity' => $request->quantities[$productId],
            ]);
        }

        return redirect()->route('warehouse.index')->with('message', 'Warehouse record updated successfully!');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return redirect()->route('warehouse.index')->with('message', 'Warehouse record deleted successfully!');
    }
}
