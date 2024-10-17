<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Payment;
use App\Models\House;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Tampilkan semua transaksi
    public function index()
    {
        // Ambil semua transaksi beserta data pembayaran yang terkait
        $transactions = Transaction::with('payment')->get();
        // $transactions = House::where('image')->get();
        return view('transactions.index', compact('transactions'));
    }
    
    public function history()
    {
        // Mengambil semua transaksi yang berstatus berhasil
        $transactions = Transaction::with('payment')->get();

        return view('Transaction.history', compact('transactions'));
    }


    // Hapus transaksi dari database
    public function destroy(Transaction $transaction)
    {
        // Ambil house_id dari transaksi yang akan dihapus
        $houseId = $transaction->payment->house_id;
    
        // Hapus transaksi dari database
        $transaction->delete();
    
        // Update status rumah kembali ke 'available'
        $house = House::find($houseId);
        if ($house) {
            $house->status = 'available'; // Mengubah status rumah
            $house->save(); // Simpan perubahan
        }
    
        return redirect()->route('transactions.history')->with('success', 'History Berhasil di Hapus!');
    }    
}
