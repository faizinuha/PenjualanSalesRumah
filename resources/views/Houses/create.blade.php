@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="toast-container position-fixed top-5 end--1 p-2" style="z-index: 11">
        <div class="toast align-items-center text-bg-danger border-0 show slide-down" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
    <style>
        .toast-container {
            max-width: 300px;
        }

        .slide-down {
            animation: slide-down 2s ease 0s 1 normal forwards;
        }

        @keyframes slide-down {
            from {
                transform: translateZ(-9.7rem);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .fade-out {
            animation: fade-out 1s ease forwards;
        }

        @keyframes fade-out {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                transform: translateY(-10px);
            }
        }
    </style>
@endif

<div class="container mt-5">
    <h1 class="text-center mb-4">Upload Rumah Baru</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('houses.store') }}" method="POST" enctype="multipart/form-data" id="houseForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}" placeholder="Masukkan alamat rumah" required>
                            @error('address')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" name="price" id="priceInput" class="form-control" value="{{ old('price') }}" placeholder="Masukkan harga rumah" required>
                            @error('price')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tipe" class="form-label">Tipe</label>
                            <select name="tipe" class="form-control">
                                <option value="apartement" {{ old('tipe') == 'apartement' ? 'selected' : '' }}>Apartement</option>
                                <option value="house" {{ old('tipe') == 'house' ? 'selected' : '' }}>House</option>
                            </select>
                            @error('tipe')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="image" class="form-label">Gambar Rumah</label>
                            <input type="file" name="image" class="form-control" id="imageInput" accept="image/*" onchange="previewImage(event)">
                            <img id="preview" src="#" alt="Preview Gambar" class="mt-3" style="max-width: 200px; display:none;">
                            @error('image')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 m-2">
                            <button type="submit" class="btn btn-primary btn-block">Upload Rumah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Validasi harga di client-side
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('houseForm');
        const priceInput = document.getElementById('priceInput');

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

    // Fungsi untuk menampilkan preview gambar
    function previewImage(event) {
        var image = document.getElementById('preview');
        var reader = new FileReader();

        reader.onload = function(){
            if(reader.readyState == 2){
                image.src = reader.result;
                image.style.display = 'block';
            }
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
