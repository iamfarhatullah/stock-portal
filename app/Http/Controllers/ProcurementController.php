<?php
namespace App\Http\Controllers;

use App\Models\Procurement;
use App\Models\ProcurementDetails;
use App\Models\Product;
use Illuminate\Http\Request;

class ProcurementController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $procurements = Procurement::all();
        return view('procurements.index', compact('products', 'procurements'));
    }

    public function create()
    {
        $products = Product::all();
        return view('procurements.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'paid_amount' => 'required|numeric',
            'units_ordered' => 'required|integer',
            'product_ids' => 'required|array', // Products selected via checkboxes
        ]);

        // Create the procurement record
        $procurement = Procurement::create([
            'date' => $request->date,
            'paid_amount' => $request->paid_amount,
            'units_ordered' => $request->units_ordered,
        ]);

        // Attach products to the procurement
        foreach ($request->product_ids as $productId) {
            ProcurementDetails::create([
                'procurement_id' => $procurement->id,
                'product_id' => $productId,
            ]);
        }

        return redirect()->route('procurements.index')->with('success', 'Procurement created successfully.');
    }


    public function edit($id)
    {
        $procurement = Procurement::findOrFail($id);
        $products = Product::all();
        return view('procurements.edit', compact('procurement', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'paid_amount' => 'required|numeric',
            'units_ordered' => 'required|integer',
            'product_ids' => 'required|array',
        ]);

        // Update procurement record
        $procurement = Procurement::findOrFail($id);
        $procurement->update([
            'date' => $request->date,
            'paid_amount' => $request->paid_amount,
            'units_ordered' => $request->units_ordered,
        ]);

        // Delete existing product relationships and reattach
        $procurement->details()->delete();
        foreach ($request->product_ids as $productId) {
            ProcurementDetails::create([
                'procurement_id' => $procurement->id,
                'product_id' => $productId,
            ]);
        }

        return redirect()->route('procurements.index')->with('success', 'Procurement updated successfully.');
    }

    public function destroy($id)
    {
        $procurement = Procurement::findOrFail($id);
        
        // Delete related procurement details first
        $procurement->details()->delete();
        
        // Now delete the procurement
        $procurement->delete();

        return redirect()->route('procurements.index')->with('success', 'Procurement deleted successfully.');
    }

}


?>