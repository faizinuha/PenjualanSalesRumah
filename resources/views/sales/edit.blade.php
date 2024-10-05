@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="form-container">
                <h3>Edit Penjualan</h3>
                <form action="{{ route('sales.update', $sale->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Menggunakan metode PUT untuk update -->

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Sales Agent</label>
                        <select name="user_id" class="form-select">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $sale->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="house_id" class="form-label">Rumah</label>
                        <select name="house_id" class="form-select">
                            @foreach ($houses as $house)
                                <option value="{{ $house->id }}" {{ $sale->house_id == $house->id ? 'selected' : '' }}>
                                    {{ $house->address }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sale_date" class="form-label">Tanggal Penjualan</label>
                        <input type="date" name="sale_date" class="form-control" value="{{ old('sale_date', $sale->sale_date) }}">
                    </div>

                    <div class="mb-3">
                        <label for="total_price" class="form-label">Total Harga</label>
                        <input type="number" name="total_price" class="form-control" value="{{ old('total_price', $sale->total_price) }}" placeholder="Enter total price">
                        @error('total_price')
                          <div class="text-center" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color: red; ">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Update Penjualan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
