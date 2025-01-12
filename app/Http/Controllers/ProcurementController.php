<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Procurement;
use Illuminate\Http\Request;

class ProcurementController extends Controller
{
    public function index()
    {
        $procurements = Procurement::with('product')->get();
        return view('procurements.index', compact('procurements'));
    }

    public function create()
    {
        $products = Product::all();
        return view('procurements.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'date' => 'required|date',
            'paid_amount' => 'required|numeric',
            'units_ordered' => 'required|integer',
        ]);

        Procurement::create($request->all());
        return redirect()->route('procurements.index')->with('message', 'Procurement record created successfully.');
    }

    public function edit(Procurement $procurement)
    {
        $products = Product::all();
        return view('procurements.edit', compact('procurement', 'products'));
    }

    public function update(Request $request, Procurement $procurement)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'date' => 'required|date',
            'paid_amount' => 'required|numeric',
            'units_ordered' => 'required|integer',
        ]);

        $procurement->update($request->all());
        return redirect()->route('procurements.index')->with('message', 'Procurement record updated successfully.');
    }

    public function destroy(Procurement $procurement)
    {
        $procurement->delete();
        return redirect()->route('procurements.index')->with('message', 'Procurement record deleted successfully.');
    }
}

?>