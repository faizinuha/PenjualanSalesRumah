<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\House;
use Illuminate\Http\Request;

class fasilitasController extends Controller
{
    // Menampilkan daftar fasilitas
    public function index()
    {
        $fasilitas = Fasilitas::with('house')->get();
        return view('fasilitas.index', compact('fasilitas'));
    }

    // Form untuk menambahkan fasilitas baru
    public function create()
    {
        $houses = House::all(); // Untuk pilihan rumah
        return view('fasilitas.create', compact('houses'));
    }

    // Menyimpan fasilitas baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'house_id' => 'required|exists:houses,id',
            'description' => 'nullable',
        ]);

        Fasilitas::create($request->all());
        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    // Menampilkan form edit fasilitas
    public function edit(Fasilitas $fasilita)
    {
        $houses = House::all();
        return view('fasilitas.edit', compact('fasilita', 'houses'));
    }

    // Memperbarui data fasilitas
    public function update(Request $request, Fasilitas $fasilita)
    {
        $request->validate([
            'name' => 'required',
            'house_id' => 'required|exists:houses,id',
            'description' => 'nullable',
        ]);

        $fasilita->update($request->all());
        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui!');
    }

    // Menghapus fasilitas
    public function destroy(Fasilitas $fasilita)
    {
        $fasilita->delete();
        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus!');
    }
}
