<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Payment;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Tampilkan semua transaksi
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    // Tampilkan form untuk membuat transaksi baru
    public function create()
    {
        $payments = Payment::all(); // Data payment untuk relasi
        return view('transactions.create', compact('payments'));
    }

    // Simpan transaksi baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'payment_id' => 'required',
            'transaction_status' => 'required|string|max:255',
        ]);

        Transaction::create([
            'payment_id' => $request->payment_id,
            'transaction_status' => $request->transaction_status,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    // Tampilkan detail transaksi
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    // Tampilkan form untuk edit transaksi
    public function edit(Transaction $transaction)
    {
        $payments = Payment::all();
        return view('transactions.edit', compact('transaction', 'payments'));
    }

    // Update transaksi yang ada di database
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'payment_id' => 'required',
            'transaction_status' => 'required|string|max:255',
        ]);

        $transaction->update([
            'payment_id' => $request->payment_id,
            'transaction_status' => $request->transaction_status,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    // Hapus transaksi dari database
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
