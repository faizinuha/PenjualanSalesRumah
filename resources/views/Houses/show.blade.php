@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Detail Rumah</h1>
        <div class="card shadow-sm rounded-4 p-4 mb-5">
            <div class="row">
                <!-- Informasi Rumah -->
                <div class="col-md-6">
                    <div class="mb-4">
                        <caption>Name Sales: @foreach ($house->sales as $sale)
                            {{$sale->user->name}}
                        @endforeach</caption>
                        <h4 class="text-primary mb-3">Alamat: {{ $house->address }}</h4>
                        <p class="fs-5">Harga: <strong>Rp {{ number_format($house->price, 0, ',', '.') }}</strong></p>
                        <p>Status: 
                            <span class="badge {{ $house->status == 'available' ? 'bg-success' : 'bg-danger' }}">
                                <i class="fas {{ $house->status == 'available' ? 'fa-check-circle' : 'fa-times-circle' }}"></i> 
                                {{ ucfirst($house->status) }}
                            </span>
                        </p>
                        <h6 class="text-primary mb-3">Alamat: {{ $house->tipe }}</h6>
            <!-- Menampilkan Fasilitas yang terkait -->

                        <h4 class="text-secondary">Fasilitas:</h4>
                        @if($house->fasilitas->isEmpty())
                        <p class="text-muted">Rumah ini belum memiliki fasilitas.</p>
                    @else
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            @foreach($house->fasilitas as $fasilitas)
                                <div class="col">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $fasilitas->name }}</h5>
                                            <p class="card-text">{{ $fasilitas->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    </div>
                </div>
                <!-- Gambar Rumah -->
                <div class="col-md-6 text-center">
                    @if($house->image)
                        <p class="fw-bold">Gambar Rumah:</p>
                        <img src="{{ asset('storage/' . $house->image) }}" alt="House Image" class="img-fluid rounded shadow-sm" style="max-width: 100%; border-radius: 12px;">
                    @else
                        <p class="text-muted">Tidak ada gambar tersedia</p>
                    @endif
                </div>
            </div>
            <!-- Tombol Kembali -->
            <div>
                <a onclick="history.back()" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Rumah
                </a>
                <a onclick="history.back()" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i>Beli
                </a>
            </div>
                
    </div>
@endsection
