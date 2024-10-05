@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Rumah</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('houses.update', $house->id) }}" method="POST" enctype="multipart/form-data" id="editHouseForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $house->address) }}" required>
                            @error('address')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $house->price) }}" required>
                            @error('price')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="available" {{ old('status', $house->status) == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="sold" {{ old('status', $house->status) == 'sold' ? 'selected' : '' }}>Sold</option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tipe" class="form-label">Tipe</label>
                            <select class="form-select" id="tipe" name="tipe" required>
                                <option value="apartement" {{ old('tipe', $house->tipe) == 'apartement' ? 'selected' : '' }}>Apartement</option>
                                <option value="house" {{ old('tipe', $house->tipe) == 'house' ? 'selected' : '' }}>House</option>
                            </select>
                            @error('tipe')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if($house->image)
                                <div class="mt-2">
                                    <p>Gambar Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                            @error('image')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Validasi harga di client-side
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editHouseForm');
        const priceInput = document.getElementById('price');

        form.addEventListener('submit', function(event) {
            const price = parseInt(priceInput.value);

            // Validasi harga negatif dan melebihi batas
            if (price < 0) {
                event.preventDefault();
                alert('Harga tidak boleh negatif. Silakan masukkan harga yang valid.');
            } else if (price > 999999999) {
                event.preventDefault();
                alert('Harga tidak boleh lebih dari 100.000.000.');
            }
        });
    });
</script>
@endsection
