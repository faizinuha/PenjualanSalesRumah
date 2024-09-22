@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Upload Rumah Baru</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('houses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <input type="text" name="address" class="form-control" placeholder="Masukkan alamat rumah" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" name="price" class="form-control" placeholder="Masukkan harga rumah" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="available">Available</option>
                                    <option value="sold">Sold</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tipe" class="form-label">Status</label>
                                <select name="tipe" class="form-control">
                                    <option value="apartement">apartement</option>
                                    <option value="house">house</option>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="image" class="form-label">Gambar Rumah</label>
                                <input type="file" name="image" class="form-control">
                                {{-- @if($house->image)
                                <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" class="mt-2" style="max-width: 200px;">
                            @endif --}}
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block">Upload Rumah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
