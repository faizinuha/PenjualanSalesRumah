@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Penjualan</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('sales.update', $sale->id) }}" id="sales" method="POST" enctype="multipart/form-data" id="editSaleForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Sales Agent</label>
                            <select name="user_id" class="form-select" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $sale->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="house_id" class="form-label">Rumah</label>
                            <select name="house_id" class="form-select" required>
                                @foreach ($houses as $house)
                                    <option value="{{ $house->id }}" {{ $sale->house_id == $house->id ? 'selected' : '' }}>
                                        {{ $house->address }}
                                    </option>
                                @endforeach
                            </select>
                            @error('house_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sale_date" class="form-label">Tanggal Penjualan</label>
                            <input type="date" name="sale_date" class="form-control" value="{{ old('sale_date', $sale->sale_date) }}" required>
                            @error('sale_date')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_price" class="form-label">Total Harga</label>
                            <input type="number" name="total_price" class="form-control" value="{{ old('total_price', $sale->total_price) }}"required>
                            @error('total_price')
                            <div class="text-danger">{{ $message }}</div> <!-- Pesan error validasi -->
                        @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Perbarui Penjualan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- 
<script>
    // Validasi harga di client-side
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('sales');
        const priceInput = document.getElementById('total_price');

        form.addEventListener('submit', function(event) {
            const total_price = parseInt(priceInput.value);

            // Validasi harga negatif dan melebihi batas
            if (total_price < 0) {
                event.preventDefault();
                alert('Harga tidak boleh negatif. Silakan masukkan harga yang valid.');
            } else if (total_price > 999999999) {
                event.preventDefault();
                alert('Harga tidak boleh lebih dari 100.000.000.');
            }
        });
    });
</script> --}}
@endsection
