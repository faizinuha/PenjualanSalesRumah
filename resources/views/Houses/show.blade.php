@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Detail Rumah</h1>
        <div class="card shadow-sm rounded-4 p-4 mb-5">
            <div class="row">
                <!-- Informasi Rumah -->
                <div class="col-md-6 pe-4"> <!-- Added padding-end for right spacing -->
                    <div class="mb-4">
                        <h4 class="text-primary mb-3">Alamat: {{ $house->address }}</h4>
                        <p class="fs-5">Harga: <strong>Rp {{ number_format($house->price, 0, ',', '.') }}</strong></p>

                        @forelse ($house->sales as $sale)
                            <p class="fs-5">Total: <strong>{{ number_format($sale->total_price, 0, ',', '.') }}</strong></p>
                        @empty
                            <p class="text-muted">Belum ada penjualan.</p>
                        @endforelse

                        <!-- Status Rumah -->
                        <p>Status:
                            <span class="badge {{ $house->status == 'available' ? 'bg-success' : 'bg-danger' }}">
                                <i class="fas {{ $house->status == 'available' ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                {{ ucfirst($house->status) }}
                            </span>
                        </p>

                        <!-- Nama Sales -->
                        <p>Nama Sales:
                            <strong>
                                @foreach ($house->sales as $sale)
                                    {{ $sale->user->name }}@if(!$loop->last), @endif
                                @endforeach
                            </strong>
                        </p>

                        <h6 class="text-primary mb-3">Tipe Rumah: {{ $house->tipe }}</h6>

                        <!-- Fasilitas -->
                        <h4 class="text-secondary">Fasilitas:</h4>
                        @if ($house->fasilitas->isEmpty())
                            <p class="text-muted">Rumah ini belum memiliki fasilitas.</p>
                        @else
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                @foreach ($house->fasilitas as $fasilitas)
                                    <div class="col">
                                        <div class="card h-100 shadow-sm border-0">
                                            <div class="card-body d-flex align-items-center">
                                                <div class="me-3">
                                                    <i class="fas fa-home fa-2x text-primary"></i> <!-- Icon fasilitas -->
                                                </div>
                                                <div>
                                                    <h5 class="card-title mb-1">{{ $fasilitas->name }}</h5> <!-- Added title for facility -->
                                                    <p class="card-text text-muted">{{ $fasilitas->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Gambar Rumah -->
                <div class="col-md-6 text-center ps-4"> <!-- Added padding-start for left spacing -->
                    @if ($house->image)
                        <p class="fw-bold mb-3">Gambar Rumah:</p>
                        <img src="{{ asset('storage/' . $house->image) }}" alt="House Image"
                            class="img-fluid rounded shadow-sm" style="max-width: 100%; border-radius: 12px;">
                    @else
                        <p class="text-muted">Tidak ada gambar tersedia</p>
                    @endif
                </div>
            </div>

            <!-- Tombol Kembali dan Beli -->
            <div class="mt-4 d-flex justify-content-between">
                <a onclick="history.back()" class="btn btn-outline-primary px-4 py-2">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Rumah
                </a>
                <a href="{{route('payments.create', $house->id)}}" class="btn btn-success px-4 py-2" id="sold">
                    <i class="fas fa-shopping-cart"></i> Beli
                </a>
                {{-- {{ route('buy.house', $house->id) }} --}}
            </div>
        </div>
    </div>
    @if($house->status == 'sold')
    <script>
        document.getElementById('sold').addEventListener('click', function (event) {
            event.preventDefault();
            alert('Rumah ini sudah terjual!');
        });

        // Men-disable tombol beli
        document.getElementById('sold').disabled = true;
    </script>
@endif
@endsection

<style>
    .card {
        transition: box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .btn {
        border-radius: 25px;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn:hover {
        background-color: #1d8f31;
        transform: translateY(-2px);
    }

    .badge {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
    }

    img {
        transition: transform 0.3s ease;
    }

    img:hover {
        transform: scale(1.05);
    }

    .card-body {
        padding: 1.5rem;
    }
</style>
