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

        $procurement = Procurement::create([
            'date' => $request->date,
            'paid_amount' => $request->paid_amount,
            'units_ordered' => $units_ordered,
        ]);

        foreach ($request->product_ids as $productId) {
            ProcurementDetails::create([
                'procurement_id' => $procurement->id,
                'product_id' => $productId,
                'quantity' => $request->quantities[$productId],
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
        $procurement = Procurement::findOrFail($id);
        $procurement->update([
            'date' => $request->date,
            'paid_amount' => $request->paid_amount,
            'units_ordered' => $units_ordered,
        ]);

        $procurement->details()->delete();
        foreach ($request->product_ids as $productId) {
            ProcurementDetails::create([
                'procurement_id' => $procurement->id,
                'product_id' => $productId,
                'quantity' => $request->quantities[$productId],
            ]);
        }
        return redirect()->route('procurements.index')->with('success', 'Procurement updated successfully.');
    }

    public function destroy($id)
    {
        $procurement = Procurement::findOrFail($id);
        $procurement->details()->delete();
        $procurement->delete();

        return redirect()->route('procurements.index')->with('success', 'Procurement deleted successfully.');
    }
}


?>