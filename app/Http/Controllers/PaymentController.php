<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function create($id)
    {
        // Fetch houses that are available
        // $house = House::find($id)->first();

        $house = House::find($id);

        // Memastikan bahwa rumah ditemukan
        if (!$house) {
            return redirect()->back()->with('error', 'Rumah tidak ditemukan.');
        }
        return view('payments.create', compact('house'));
    }

    public function store(Request $request)
    {
        // Validate input payment data
        $request->validate([
            'house_id' => 'required|exists:houses,id',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|in:atm,Tunai,Kartu Kredit', // Ensure valid payment methods
        ]);

        // Create a new payment
        $payment = Payment::create([
            'house_id' => $request->house_id,
            'user_id' => Auth::user()->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method, // Store payment method
        ]);
        $transactions = Transaction::create([
            'payment_id' => $payment->id,
            'transaction_status' => 'success',
        ]);

        // Update the house status to "sold"
        $house = House::find($request->house_id);
        $house->status = 'sold';
        $house->save();

        // Redirect with success message
        return redirect()->route('houses.index')->with('success', 'Pembayaran berhasil, status rumah telah berubah menjadi terjual.');
    }
}
