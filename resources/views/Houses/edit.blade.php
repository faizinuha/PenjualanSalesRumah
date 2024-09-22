@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Rumah</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('houses.update', $house->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $house->address }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $house->price }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="available" {{ $house->status == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="sold" {{ $house->status == 'sold' ? 'selected' : '' }}>Sold</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tipe" class="form-label">Status</label>
                            <select class="form-select" id="tipe" name="tipe" required>
                                <option value="apartement" {{ $house->status == 'apartement' ? 'selected' : '' }}>apartement</option>
                                <option value="house" {{ $house->status == 'house' ? 'selected' : '' }}>house</option>
                            </select>
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
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
