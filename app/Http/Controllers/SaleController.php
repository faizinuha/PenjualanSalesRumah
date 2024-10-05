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
        $sales = Sale::with(['user', 'house', 'fasilitas'])->get();

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $users = User::all();
        $houses = House::all();
        $fasilitas = Fasilitas::all();
        return view('sales.create', compact('users', 'houses', 'fasilitas'));
    }

    public function store(Request $request)
    {
        // Validasi input termasuk validasi total_price tidak boleh negatif, min dan max
        $request->validate([
            'user_id' => 'required',
            'house_id' => 'required',
            'sale_date' => 'required|date',
            'total_price' => 'required|integer|min:0|max:999999999999|gt:0', // harga minimal 100 ribu, maksimal 10 miliar
        ], [
            'total_price.gt' => 'Harga tidak boleh negatif atau nol.', // pesan error untuk harga negatif
            'total_price.min' => 'Harga melebihi Batas', // pesan error untuk harga minimal
            'total_price.max' => 'Harga tidak boleh lebih dari Rp10.000.000.000', // pesan error untuk harga maksimal
        ]);

        // Cek apakah rumah sudah terjual
        $existingSale = Sale::where('house_id', $request->house_id)->first();
        if ($existingSale) {
            return redirect()->back()->with('error', 'Rumah ini sudah terjual!');
        }

        // Simpan penjualan jika rumah belum terjual
        Sale::create($request->all());
        return redirect()->route('sales.index')->with('success', 'Penjualan berhasil disimpan!');
    }
    public function edit($id)
    {
        // Mengambil data penjualan berdasarkan ID
        $sale = Sale::findOrFail($id);

        // Mengambil data user, house, dan fasilitas untuk form edit
        $users = User::all();
        $houses = House::all();
        $fasilitas = Fasilitas::all();

        // Menampilkan view edit dengan data yang sudah diambil
        return view('sales.edit', compact('sale', 'users', 'houses', 'fasilitas'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required',
            'house_id' => 'required',
            'sale_date' => 'required|date',
            'total_price' => 'required|integer|min:0|max:999999999999|gt:0', // validasi harga
        ], [
            'total_price.gt' => 'Harga tidak boleh negatif atau nol.',
            'total_price.min' => 'Harga melebihi Batas',
            'total_price.max' => 'Harga tidak boleh lebih dari Rp10.000.000.000',
        ]);

        // Mengambil data penjualan berdasarkan ID
        $sale = Sale::findOrFail($id);

        // Cek apakah rumah yang diedit sudah terjual kepada orang lain
        $existingSale = Sale::where('house_id', $request->house_id)->where('id', '!=', $id)->first();
        if ($existingSale) {
            return redirect()->back()->with('error', 'Rumah ini sudah terjual ke penjualan lain!');
        }

        // Update data penjualan dengan input yang baru
        $sale->update($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('sales.index')->with('success', 'Penjualan berhasil diupdate!');
    }
}
