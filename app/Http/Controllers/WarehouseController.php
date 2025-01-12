<?php

namespace App\Http\Controllers;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('warehouse.index', compact('warehouses'));
    }

    public function create()
    {
        return view('warehouse.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'units' => 'required|integer',
            'date' => 'required|date',
        ]);

        Warehouse::create($request->all());

        return redirect()->route('warehouse.index')->with('message', 'Warehouse record added successfully!');
    }

    public function edit(Warehouse $warehouse)
    {
        return view('warehouse.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'cost' => 'required|numeric',
            'units' => 'required|integer',
            'date' => 'required|date',
        ]);

        $warehouse->update($request->all());

        return redirect()->route('warehouse.index')->with('message', 'Warehouse record updated successfully!');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect()->route('warehouse.index')->with('message', 'Warehouse record deleted successfully!');
    }
}
