<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StockController extends Controller
{
    public function index(): View
    {
        $stocks = Stock::with('product')->latest()->paginate(10);

        return view('stocks.index', compact('stocks'));
    }

    public function create(): View
    {
        $products = Product::all();

        return view('stocks.create', compact('products'));
    }

    public function store(StoreStockRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['stock_code'] = 'STK-' . now()->format('Ymd') . '-' . str_pad(Stock::count() + 1, 4, '0', STR_PAD_LEFT);
        $stock = Stock::create($data);

        $product = Product::findOrFail($data['product_id']);
        $product->stock += $data['qty'];
        $product->save();

        return redirect()->route('stocks.index')->with('success', 'Stock berhasil ditambahkan.');
    }

    public function edit(Stock $stock): View
    {
        $products = Product::all();

        return view('stocks.edit', compact('stock', 'products'));
    }

    public function update(UpdateStockRequest $request, Stock $stock): RedirectResponse
    {
        $data = $request->validated();
        $stock->update($data);

        return redirect()->route('stocks.index')->with('success', 'Stock berhasil diperbarui.');
    }

    public function destroy(Stock $stock): RedirectResponse
    {
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock berhasil dihapus.');
    }
}
