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
        // Validasi input
        $request->validate([
            'user_id' => 'required',
            'house_id' => 'required',
            'sale_date' => 'required|date',
            'total_price' => 'required|integer',
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
}
