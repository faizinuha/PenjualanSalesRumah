<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    // Fungsi untuk menampilkan form upload rumah
    public function create()
    {
        $house = House::all();
        return view('houses.create', compact('house'));
    }

    // Fungsi untuk menyimpan data rumah baru
    public function store(Request $request)
    {
        // Validasi data di server-side
        $request->validate([
            'address' => 'required|string|max:255|unique:Houses,address,id',
            'price' => 'required|integer|min:0|max:999999999', // Validasi harga antara 0 hingga 10 juta
            'status' => 'required|in:sold,available',
            'image' => 'required|mimes:jpeg,png,jpg', // Validasi gambar
            'tipe' => 'required|in:apartement,house',
        ], [
            'address.unique' => 'Alamat rumah ini sudah terdaftar. Silakan masukkan alamat yang berbeda.',
            'price.min' => 'Harga tidak boleh negatif.', // Pesan error harga negatif
            'price.max' => 'Harga tidak boleh lebih dari 10.000.000.', // Pesan error harga terlalu tinggi
        ]);

        // Simpan gambar
        $imageStore = $request->file('image')->store('house', 'public');

        // Simpan data rumah
        House::create([
            'address' => $request->address,
            'price' => $request->price,
            'status' => $request->status,
            'image' => $imageStore,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('houses.index')->with('success', 'Data Rumah Berhasil di Buat!');
    }

    // Fungsi untuk menampilkan daftar rumah
    public function index()
    {
        $houses = House::all();
        return view('houses.index', compact('houses'));
    }

    // Fungsi untuk menampilkan form edit rumah
    public function edit($id)
    {
        $house = House::findOrFail($id);
        return view('houses.edit', compact('house'));
    }

    // Fungsi untuk memperbarui data rumah
   // Fungsi untuk memperbarui data rumah
public function update(Request $request, $id)
{
    $house = House::findOrFail($id);

    // Validasi data input
    $request->validate([
        'address' => 'required|string|max:255|unique:Houses,address,' . $id,
        'price' => 'required|integer|min:0|max:999999999', // Validasi harga antara 0 hingga 10 juta
        'status' => 'required|in:sold,available',
        'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        'tipe' => 'required|in:apartement,house',
    ], [
        'address.unique' => 'Alamat rumah ini sudah terdaftar. Silakan masukkan alamat yang berbeda.',
        'price.min' => 'Harga tidak boleh negatif.', // Pesan error untuk harga negatif
        'price.max' => 'Harga tidak boleh lebih dari 10.000.000.', // Pesan error harga terlalu tinggi
    ]);

    // Jika ada gambar baru yang diunggah
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($house->image) {
            $imagePath = public_path('storage/' . $house->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Hapus gambar lama dari storage
            }
        }

        // Simpan gambar baru
        $imageStore = $request->file('image')->store('house', 'public');
        $house->image = $imageStore; // Simpan nama file gambar baru
    }

    // Perbarui data rumah tanpa mengganti gambar jika tidak ada gambar baru
    $house->address = $request->address;
    $house->price = $request->price;
    $house->status = $request->status;
    $house->tipe = $request->tipe; // Pastikan tipe juga diperbarui jika perlu
    $house->save();

    return redirect()->route('houses.index')->with('success', 'Data rumah berhasil diperbarui.');
}


    // Fungsi untuk menampilkan detail rumah
    public function show($id)
    {
        $house = House::with('fasilitas')->findOrFail($id);
        return view('Houses.show', compact('house'));
    }

    // Fungsi untuk menghapus rumah
    public function destroy($id)
    {
        $house = House::findOrFail($id);

        // Jika ada gambar yang tersimpan, hapus dari direktori
        if ($house->image) {
            $imagePath = public_path('storage/' . $house->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Hapus gambar dari storage
            }
        }

        $house->delete(); // Hapus data rumah dari database

        return redirect()->route('houses.index')->with('success', 'Data rumah berhasil dihapus.');
    }
}
