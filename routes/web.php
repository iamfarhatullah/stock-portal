<?php

use App\Http\Controllers\SaleController;
use App\Http\Controllers\StocksRecordController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'preventBackHistory'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth', 'preventBackHistory')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    Route::get('stocks', [StocksRecordController::class, 'index'])->name('stocks.index');
    Route::get('stocks/{product}', [StocksRecordController::class, 'productstock'])->name('stocks.product-stock');
    Route::get('stocks/{product}/create', [StocksRecordController::class, 'create'])->name('stocks.create');
    Route::post('stocks/{product}', [StocksRecordController::class, 'store'])->name('stocks.store');
    
    Route::get('warehouse', [WarehouseController::class, 'index'])->name('warehouse.index');
    Route::get('warehouse/create', [WarehouseController::class, 'create'])->name('warehouse.create');
    Route::post('warehouse', [WarehouseController::class, 'store'])->name('warehouse.store');
    Route::get('warehouse/{warehouse}/edit', [WarehouseController::class, 'edit'])->name('warehouse.edit');
    Route::put('warehouse/{warehouse}', [WarehouseController::class, 'update'])->name('warehouse.update');
    Route::delete('warehouse/{warehouse}', [WarehouseController::class, 'destroy'])->name('warehouse.destroy');

    Route::resource('procurements', ProcurementController::class);

    Route::get('sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('sales', [SaleController::class, 'store'])->name('sales.store');

    Route::get('/stock/report', [ReportController::class, 'generateStockReport'])->name('reports.stock_report');
});

require __DIR__.'/auth.php';
