<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\StocksRecord;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function generateStockReport(Request $request)
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

        // return view('stocks.index', compact('stockRecords', 'selectedMonth', 'products'));

        $pdf = Pdf::loadView('reports.stock_report', compact('stockRecords', 'selectedMonth', 'products'))->setPaper('a4', 'portrait');
        return $pdf->stream('sample_report.pdf');
    }

}
