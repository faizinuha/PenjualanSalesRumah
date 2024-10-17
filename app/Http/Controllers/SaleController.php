<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\House;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['user', 'house'])->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $users = User::all();
        $houses = House::all();
        return view('sales.create', compact('users', 'houses'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required',
            'house_id' => 'required',
            'sale_date' => 'required|date',
            'total_price' => 'required|integer|min:0|max:10000000000', // Validasi harga minimal 0 dan max 10 miliar
        ], [
            'total_price.min' => 'Harga tidak boleh nol atau negatif.',
            'total_price.max' => 'Harga tidak boleh lebih dari Rp10.000.000.000.',
        ]);

        // Cek apakah rumah sudah terjual
        if (Sale::where('house_id', $request->house_id)->exists()) {
            return redirect()->back()->with('error', 'Rumah ini sudah terjual!');
        }

        // Simpan penjualan jika rumah belum terjual
        Sale::create($request->all());
        return redirect()->route('sales.index')->with('success', 'Penjualan berhasil disimpan!');
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $users = User::all();
        $houses = House::all();
        return view('sales.edit', compact('sale', 'users', 'houses'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required',
            'house_id' => 'required',
            'sale_date' => 'required|date',
            'total_price' => 'required|integer|min:0|max:10000000000',
        ], [
            'total_price.min' => 'Harga tidak boleh negatif.',
            'total_price.max' => 'Harga tidak boleh lebih dari Rp10.000.000.000.',
        ]);

        // Ambil data penjualan
        $sale = Sale::findOrFail($id);

        // Cek apakah rumah sudah terjual ke penjualan lain
        if (Sale::where('house_id', $request->house_id)->where('id', '!=', $sale->id)->exists()) {
            return redirect()->back()->with('error', 'Rumah ini sudah terjual ke penjualan lain!');
        }

        // Update penjualan
        $sale->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('sales.index')->with('success', 'Penjualan berhasil diupdate!');
    }
}
