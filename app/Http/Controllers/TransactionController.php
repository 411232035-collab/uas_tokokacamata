<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        $transactions = Transaction::with('product')->latest()->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create(): View
    {
        $products = Product::all();

        return view('transactions.create', compact('products'));
    }

    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['transaction_number'] = 'TRX-' . now()->format('Ymd') . '-' . str_pad(Transaction::count() + 1, 5, '0', STR_PAD_LEFT);
        $data['subtotal'] = $data['qty'] * $data['price'];
        Transaction::create($data);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Transaction $transaction): View
    {
        $products = Product::all();

        return view('transactions.edit', compact('transaction', 'products'));
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction): RedirectResponse
    {
        $data = $request->validated();
        $data['subtotal'] = $data['qty'] * $data['price'];
        $transaction->update($data);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction): RedirectResponse
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
